<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Instagram Connection</h1>
    </x-slot>

    <div class="card card-flush shadow-sm mb-5">
        <div class="card-header">
            <h3 class="card-title">Connection Status</h3>
            <div class="card-toolbar d-flex gap-2">
                @if ($connection && $connection->isConnected())
                    <form action="{{ route('administrator.instagram.refresh') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light-primary">Refresh Feed Cache</button>
                    </form>
                    <form action="{{ route('administrator.instagram.disconnect') }}" method="POST" onsubmit="return confirm('Disconnect Instagram account?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light-danger">Disconnect</button>
                    </form>
                @else
                    <a href="{{ route('administrator.instagram.connect') }}" class="btn btn-sm btn-primary">
                        Connect with Instagram
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if ($connection && $connection->isConnected())
                <div class="row g-4">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Instagram Account</p>
                        <p class="fw-bold mb-0">{{ '@' . ($connection->instagram_username ?: 'connected') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Token Expires</p>
                        <p class="fw-bold mb-0">{{ $connection->token_expires_at?->format('d M Y H:i') ?: 'Unknown' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Homepage Feed</p>
                        <p class="fw-bold mb-0">Latest 12 posts, cached for 1 hour</p>
                    </div>
                </div>
            @else
                <p class="mb-2">Connect your Instagram Business account to show the latest posts on the homepage.</p>
                <ul class="text-muted mb-0">
                    <li>Instagram must be a Business or Creator account</li>
                    <li>Meta app use case: <strong>Manage messaging &amp; content on Instagram</strong></li>
                    <li>Add redirect URI: <code>{{ config('services.instagram.redirect') }}</code></li>
                    <li>Use your Meta app ID and secret in <code>.env</code></li>
                </ul>
            @endif
        </div>
    </div>

    @if (! empty($posts))
        <div class="card card-flush shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Preview</h3>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach ($posts as $post)
                        <div class="col-6 col-md-4 col-lg-2">
                            <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener noreferrer" class="d-block ratio ratio-1x1 overflow-hidden rounded">
                                <img src="{{ $post['image_url'] }}" alt="Instagram post" class="img-fluid object-fit-cover">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</x-base-layout>
