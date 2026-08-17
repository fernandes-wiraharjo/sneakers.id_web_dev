<?php

namespace Modules\ExternalReview\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\ExternalReview\Repositories\ExternalReviewRepository;

class ExternalReviewPublicController extends Controller
{
    protected $repository;

    public function __construct(ExternalReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function show(string $token)
    {
        $link = $this->repository->getByToken($token);

        if (! $link || ! $link->product) {
            abort(404);
        }

        $product = $link->product;
        $productImage = getImage($product->image, 'products/' . $product->product_code);
        $ogImage = $productImage;

        if (str_contains($ogImage, 'data:image')) {
            $ogImage = asset('stores-info/opengraph-default.jpg');
        }

        return view('externalreview::public.review', [
            'link' => $link,
            'product' => $product,
            'productImage' => $productImage,
            'ogTitle' => $product->product_name . ' - Review',
            'ogDescription' => 'Share your review for ' . $product->product_name,
            'ogImage' => $ogImage,
            'ogUrl' => $link->review_url,
        ]);
    }
}
