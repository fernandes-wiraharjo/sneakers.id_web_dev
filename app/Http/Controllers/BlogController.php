<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Blog;
use Modules\Brand\Repositories\BrandRepository;
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

        // Popular posts sorted by visitor count (then by latest)
        $blog_popular = Blog::query()
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('visitor_count')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Brand list for "BUY BY PRODUCT"
        $brands = $this->brandRepository->getActiveMenuBrand();

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
        $brands = $this->brandRepository->getActiveMenuBrand();

        // Popular posts for sidebar (exclude current)
        $popular = Blog::query()
            ->where('is_active', true)
            ->where('id', '!=', $blog->id)
            ->with('category')
            ->orderByDesc('visitor_count')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('bootstrap.blog-single', [
            'headerImageURL' => $headerImageURL,
            'blog' => $blog,
            'brands' => $brands,
            'popular' => $popular,
        ]);
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

        // Popular posts for sidebar
        $popular = Blog::query()
            ->where('is_active', true)
            ->with('category')
            ->orderByDesc('visitor_count')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        // Brand list for "BUY BY PRODUCT"
        $brands = $this->brandRepository->getActiveMenuBrand();

        return view('bootstrap.blog-search', [
            'headerImageURL' => $headerImageURL,
            'blog_results' => $blog_results,
            'popular' => $popular,
            'brands' => $brands,
            'keyword' => $keyword,
        ]);
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
}
