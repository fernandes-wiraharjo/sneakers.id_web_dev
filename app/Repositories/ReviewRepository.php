<?php

namespace App\Repositories;

use App\Models\ReviewProduct;

class ReviewRepository extends Repository
{
    public function __construct(ReviewProduct $model)
    {
        parent::__construct($model);
    }

    /**
     * Get reviews for homepage carousel
     * Returns reviews chunked into 2 lines if more than 10 reviews exist
     * 
     * @param int $limit Maximum number of reviews to fetch (default: 20)
     * @return array ['reviews_line1' => Collection, 'reviews_line2' => Collection]
     */
    public function getReviewsForHomepage($limit = 20)
    {
        // Get customer reviews (limit, randomly)
        $reviews = $this->model
            ->with(['transaction.destination', 'product'])
            ->inRandomOrder()
            ->limit($limit)
            ->get();
        
        // If reviews > 10, chunk into 2 lines (5 each)
        if ($reviews->count() > 10) {
            $reviewsChunked = $reviews->take(10)->chunk(5);
            return [
                'reviews_line1' => $reviewsChunked->first() ?? collect(),
                'reviews_line2' => $reviewsChunked->last() ?? collect(),
            ];
        } else {
            return [
                'reviews_line1' => $reviews,
                'reviews_line2' => collect(),
            ];
        }
    }

    public function getReviewsForProduct($id)
    {
        return $this->model->where('product_id', $id)->with('transaction.destination')->get();
    }
}

