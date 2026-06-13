<?php

namespace App\Services;

use App\Models\InstagramConnection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InstagramService
{
    public const CACHE_KEY = 'instagram_feed_posts';

    public function getConnection(): ?InstagramConnection
    {
        return InstagramConnection::query()->latest('id')->first();
    }

    public function isConnected(): bool
    {
        $connection = $this->getConnection();

        return $connection && $connection->isConnected();
    }

    public function clearFeedCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function getPosts(?int $limit = null): array
    {
        $limit = $limit ?? config('instagram.posts_limit', 12);
        $ttl = config('instagram.cache_ttl', 3600);

        return Cache::remember(self::CACHE_KEY, $ttl, function () use ($limit) {
            return $this->fetchPostsFromApi($limit);
        });
    }

    public function refreshPosts(?int $limit = null): array
    {
        $this->clearFeedCache();

        return $this->getPosts($limit);
    }

    public function getAuthorizationUrl(): string
    {
        $state = Str::random(40);
        session(['instagram_oauth_state' => $state]);

        return 'https://www.instagram.com/oauth/authorize?' . http_build_query([
            'client_id' => config('services.instagram.client_id'),
            'redirect_uri' => config('services.instagram.redirect'),
            'scope' => implode(',', config('instagram.scopes', ['instagram_business_basic'])),
            'response_type' => 'code',
            'state' => $state,
        ]);
    }

    public function validateOAuthState(?string $state): bool
    {
        $expected = session('instagram_oauth_state');

        session()->forget('instagram_oauth_state');

        return $expected && $state && hash_equals($expected, $state);
    }

    public function connectFromAuthorizationCode(string $code, ?int $connectedByUserId = null): InstagramConnection
    {
        $tokenResponse = Http::asForm()->post('https://api.instagram.com/oauth/access_token', [
            'client_id' => config('services.instagram.client_id'),
            'client_secret' => config('services.instagram.client_secret'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('services.instagram.redirect'),
            'code' => $code,
        ]);

        if (! $tokenResponse->successful()) {
            throw new \RuntimeException($this->extractErrorMessage($tokenResponse->json(), 'Instagram authorization failed.'));
        }

        $payload = $tokenResponse->json('data.0') ?? $tokenResponse->json();
        $shortLivedToken = $payload['access_token'] ?? null;
        $userId = $payload['user_id'] ?? null;

        if (! $shortLivedToken || ! $userId) {
            throw new \RuntimeException('Instagram did not return an access token.');
        }

        $longLivedToken = $this->exchangeInstagramLongLivedToken($shortLivedToken);
        $profile = $this->fetchInstagramProfile($longLivedToken);

        $this->clearFeedCache();
        InstagramConnection::query()->delete();

        return InstagramConnection::create([
            'facebook_user_id' => null,
            'facebook_page_id' => null,
            'facebook_page_name' => null,
            'instagram_business_account_id' => $profile['user_id'] ?? (string) $userId,
            'instagram_username' => $profile['username'] ?? null,
            'access_token' => $longLivedToken,
            'token_expires_at' => now()->addDays(55),
            'connected_by_user_id' => $connectedByUserId,
        ]);
    }

    public function fetchPostsFromApi(?int $limit = null): array
    {
        $limit = $limit ?? config('instagram.posts_limit', 12);
        $connection = $this->getConnection();

        if (! $connection || ! $connection->isConnected()) {
            return [];
        }

        $response = Http::get($this->instagramGraphUrl("{$connection->instagram_business_account_id}/media"), [
            'fields' => 'id,caption,media_type,media_url,thumbnail_url,permalink,timestamp,children{media_url,thumbnail_url,media_type}',
            'limit' => $limit,
            'access_token' => $connection->access_token,
        ]);

        if (! $response->successful()) {
            Log::warning('Instagram media fetch failed', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return [];
        }

        return collect($response->json('data', []))
            ->map(fn (array $item) => $this->normalizePost($item))
            ->filter(fn (array $item) => ! empty($item['image_url']))
            ->values()
            ->all();
    }

    public function disconnect(): void
    {
        InstagramConnection::query()->delete();
        $this->clearFeedCache();
    }

    public function exchangeInstagramLongLivedToken(string $shortLivedToken): string
    {
        $response = Http::get('https://graph.instagram.com/access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => config('services.instagram.client_secret'),
            'access_token' => $shortLivedToken,
        ]);

        if (! $response->successful() || ! $response->json('access_token')) {
            return $shortLivedToken;
        }

        return $response->json('access_token');
    }

    public function fetchInstagramProfile(string $accessToken): array
    {
        $response = Http::get($this->instagramGraphUrl('me'), [
            'fields' => 'user_id,username,name,account_type',
            'access_token' => $accessToken,
        ]);

        if (! $response->successful()) {
            return [];
        }

        return $response->json();
    }

    public function normalizePost(array $item): array
    {
        return [
            'id' => $item['id'] ?? null,
            'caption' => $item['caption'] ?? '',
            'media_type' => $item['media_type'] ?? 'IMAGE',
            'permalink' => $item['permalink'] ?? '#',
            'timestamp' => $item['timestamp'] ?? null,
            'image_url' => $this->resolveMediaImageUrl($item),
        ];
    }

    public function resolveMediaImageUrl(array $item): ?string
    {
        $mediaType = $item['media_type'] ?? 'IMAGE';

        if ($mediaType === 'VIDEO') {
            return $item['thumbnail_url'] ?? $item['media_url'] ?? null;
        }

        if ($mediaType === 'CAROUSEL_ALBUM') {
            $children = collect(data_get($item, 'children.data', []));

            if ($children->isNotEmpty()) {
                $first = $children->first();

                if (($first['media_type'] ?? '') === 'VIDEO') {
                    return $first['thumbnail_url'] ?? $first['media_url'] ?? null;
                }

                return $first['media_url'] ?? $first['thumbnail_url'] ?? null;
            }
        }

        return $item['media_url'] ?? $item['thumbnail_url'] ?? null;
    }

    protected function instagramGraphUrl(string $path): string
    {
        $version = config('instagram.graph_version', 'v21.0');

        return "https://graph.instagram.com/{$version}/{$path}";
    }

    protected function extractErrorMessage(?array $payload, string $fallback): string
    {
        if (! $payload) {
            return $fallback;
        }

        return $payload['error_message']
            ?? data_get($payload, 'error.message')
            ?? $fallback;
    }
}
