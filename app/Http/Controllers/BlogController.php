<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Blog\Entities\Blog;
use Modules\Brand\Repositories\BrandRepository;
use App\Models\HeaderImage;

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
}
