<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Blog;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Blog\Entities\BlogCategory;
use App\Models\HeaderImage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * @var BrandRepository
     */
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Blog homepage.
     *
     * Shows carousel, promo, latest, and popular blog posts.
     */
    public function index(Request $request)
    {
        $headerImageURL = (new HeaderImage())->getHeaderImage('common', 'Blog');

        // Carousel posts
        $blog_carousel = Blog::query()
            ->where('is_active', true)
            ->where('is_carousel', true)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Promo posts (promo category)
        $blog_promo = Blog::query()
            ->where('is_active', true)
            ->where('category_id', 'promo')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Latest posts
        $blog_latest = Blog::query()
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        // Sidebar data
        $sidebar = $this->getSidebarData();
        $blog_popular = $sidebar['popular'];
        $brands = $sidebar['brands'];

        return view('bootstrap.blog-home', compact(
            'headerImageURL',
            'blog_carousel',
            'blog_promo',
            'blog_latest',
            'blog_popular',
            'brands'
        ));
    }

    /**
     * Blog single page.
     *
     * @param string $slug
     */
    public function show(string $slug)
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        // Increment visitor count for popularity
        $blog->increment('visitor_count');

        $headerImageURL = (new HeaderImage())->getHeaderImage('common', 'Blog');
        $sidebar = $this->getSidebarData($blog->id);

        return view(
            'bootstrap.blog-single',
            array_merge([
                'headerImageURL' => $headerImageURL,
                'blog' => $blog,
            ], $sidebar)
        );
    }

    /**
     * Blog search page – search by title and plain text.
     */
    public function search(Request $request)
    {
        $keyword = trim($request->get('q', ''));

        $headerImageURL = (new HeaderImage())->getHeaderImage('common', 'Blog');

        $query = Blog::query()
            ->where('is_active', true)
            ->with('category');

        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('plain_text', 'LIKE', '%' . $keyword . '%');
            });
        }

        $blog_results = $query
            ->orderByDesc('created_at')
            ->get();

        // Build keyword-centered excerpts for search results
        if ($keyword !== '') {
            foreach ($blog_results as $result) {
                $result->search_excerpt = $this->buildSearchExcerpt(
                    $result->plain_text ?? '',
                    $keyword,
                    200,
                    100
                );
            }
        }

        // Sidebar data
        $sidebar = $this->getSidebarData();

        return view(
            'bootstrap.blog-search',
            array_merge([
                'headerImageURL' => $headerImageURL,
                'blog_results' => $blog_results,
                'keyword' => $keyword,
            ], $sidebar)
        );
    }

    /**
     * Build an excerpt centered around the first occurrence of the keyword.
     *
     * If the content is short or the keyword is near the start, this falls back
     * to a normal leading excerpt.
     */
    protected function buildSearchExcerpt(string $text, string $keyword, int $length = 140, int $padding = 40): string
    {
        $text = trim(preg_replace('/\s+/', ' ', $text));

        if ($text === '') {
            return '';
        }

        if ($keyword === '') {
            return Str::limit($text, $length);
        }

        $lowerText = mb_strtolower($text, 'UTF-8');
        $lowerKeyword = mb_strtolower($keyword, 'UTF-8');
        $pos = mb_stripos($lowerText, $lowerKeyword, 0, 'UTF-8');

        $totalLen = mb_strlen($text, 'UTF-8');

        // If keyword not found or text is already short, just use a normal excerpt
        if ($pos === false || $totalLen <= $length) {
            return Str::limit($text, $length);
        }

        // If keyword appears near the start, show from the beginning
        if ($pos <= $padding) {
            return Str::limit($text, $length);
        }

        // Start a bit before the keyword so it sits roughly in the middle
        $start = max(0, $pos - $padding);
        $snippet = mb_substr($text, $start, $length, 'UTF-8');

        $prefix = $start > 0 ? '...' : '';
        $suffix = ($start + $length) < $totalLen ? '...' : '';

        return trim($prefix . $snippet . $suffix);
    }

    /**
     * Blog category page – list posts in a given category.
     */
    public function category(Request $request, string $id)
    {
        $category = BlogCategory::query()->findOrFail($id);

        $headerImageURL = (new HeaderImage())->getHeaderImage('common', 'Blog');

        $perPage = 4;

        $blog_results = Blog::query()
            ->where('is_active', true)
            ->where('category_id', $id)
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate($perPage);

        // AJAX request for "Load More" – return only rows HTML
        if ($request->ajax()) {
            $html = view('bootstrap.parts.blog-all-items', [
                'blog_results' => $blog_results,
                'is_append' => true,
            ])->render();

            return response()->json([
                'html' => $html,
                'has_more' => $blog_results->hasMorePages(),
                'next_page' => $blog_results->currentPage() + 1,
            ]);
        }

        // Sidebar data
        $sidebar = $this->getSidebarData();

        return view(
            'bootstrap.blog-category',
            array_merge([
                'headerImageURL' => $headerImageURL,
                'blog_results' => $blog_results,
                'category' => $category,
            ], $sidebar)
        );
    }

    /**
     * Blog "all" page – latest articles with load more (append rows).
     */
    public function all(Request $request)
    {
        $headerImageURL = (new HeaderImage())->getHeaderImage('common', 'Blog');

        $perPage = 4;

        $blog_results = Blog::query()
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate($perPage);

        // AJAX request for "Load More" – return only rows HTML
        if ($request->ajax()) {
            $html = view('bootstrap.parts.blog-all-items', [
                'blog_results' => $blog_results,
                'is_append' => true,
            ])->render();

            return response()->json([
                'html' => $html,
                'has_more' => $blog_results->hasMorePages(),
                'next_page' => $blog_results->currentPage() + 1,
            ]);
        }

        // Sidebar data
        $sidebar = $this->getSidebarData();

        return view(
            'bootstrap.blog-all',
            array_merge([
                'headerImageURL' => $headerImageURL,
                'blog_results' => $blog_results,
            ], $sidebar)
        );
    }

    /**
     * Get base query for popular posts.
     *
     * @param int|null $excludeId  Optional blog ID to exclude (e.g. current post).
     */
    protected function popularQuery(int $excludeId = null)
    {
        $query = Blog::query()
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('visitor_count')
            ->orderByDesc('created_at');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query;
    }

    /**
     * Get popular posts for sidebar.
     *
     * @param int|null $excludeId  Optional blog ID to exclude (e.g. current post).
     * @param int $page
     * @param int $perPage
     */
    protected function getPopularPosts(int $excludeId = null, int $page = 1, int $perPage = 6)
    {
        $offset = max(0, ($page - 1) * $perPage);

        return $this->popularQuery($excludeId)
            ->skip($offset)
            ->take($perPage)
            ->get();
    }

    /**
     * Get common sidebar data (popular posts + brands).
     *
     * @param int|null $excludeBlogId
     * @return array{popular:\Illuminate\Support\Collection,popularHasMore:bool,brands:\Illuminate\Support\Collection}
     */
    protected function getSidebarData(int $excludeBlogId = null): array
    {
        $perPage = 4;
        $baseQuery = $this->popularQuery($excludeBlogId);
        $totalPopular = $baseQuery->count();

        $popular = $this->getPopularPosts($excludeBlogId, 1, $perPage);
        $popularHasMore = $totalPopular > $popular->count();

        return [
            'popular' => $popular,
            'popularHasMore' => $popularHasMore,
            'brands' => $this->brandRepository->getActiveMenuBrand(),
        ];
    }

    /**
     * Load more popular posts for sidebar (AJAX).
     */
    public function popular(Request $request)
    {
        $page = (int) $request->get('page', 1);
        $perPage = 4;
        $excludeId = $request->get('exclude_id');
        $excludeId = $excludeId ? (int) $excludeId : null;

        $query = $this->popularQuery($excludeId);
        $total = $query->count();

        $popular = $this->getPopularPosts($excludeId, $page, $perPage);

        $html = view('bootstrap.parts.blog-popular-items', [
            'popular' => $popular,
        ])->render();

        $offset = ($page - 1) * $perPage;
        $hasMore = ($offset + $popular->count()) < $total;

        return response()->json([
            'html' => $html,
            'has_more' => $hasMore,
            'next_page' => $page + 1,
        ]);
    }
}
