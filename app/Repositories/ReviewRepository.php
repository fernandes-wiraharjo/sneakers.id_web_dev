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

    public function getGlobalSummary(): array
    {
        $breakdown = $this->model
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $distribution[$i] = (int) ($breakdown[$i] ?? 0);
        }

        return [
            'total' => array_sum($distribution),
            'average' => round((float) ($this->model->avg('rating') ?? 0), 1),
            'distribution' => $distribution,
        ];
    }

    public function getPaginatedReviews(?int $rating = null, int $perPage = 10)
    {
        $query = $this->model
            ->with(['product', 'transaction.destination'])
            ->latest();

        if ($rating !== null) {
            $query->where('rating', $rating);
        }

        return $query->paginate($perPage)->withQueryString();
    }
}

