<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ReviewProduct;
use Illuminate\Support\Facades\Auth;

class ProductReviewForm extends Component
{
    public $transactionToken;
    public $productId;
    public $productSize;
    public $rating = 0;
    public $review = '';
    public $isSubmitted = false;
    public $productName;
    public $productImage;
    public $productCode;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|min:10|max:1000',
    ];

    protected $messages = [
        'rating.required' => 'Please select a rating.',
        'rating.min' => 'Rating must be at least 1 star.',
        'rating.max' => 'Rating cannot exceed 5 stars.',
        'review.required' => 'Please write a review.',
        'review.min' => 'Review must be at least 10 characters.',
        'review.max' => 'Review cannot exceed 1000 characters.',
    ];

    public function mount($transactionToken, $productId, $productSize, $productName = '', $productImage = '', $productCode = '')
    {
        $this->transactionToken = $transactionToken;
        $this->productId = $productId;
        $this->productSize = $productSize;
        $this->productName = $productName;
        $this->productImage = $productImage;
        $this->productCode = $productCode;

        // Check if review already exists
        $existingReview = ReviewProduct::where('transaction_token', $transactionToken)
            ->where('product_id', $productId)
            ->where('product_size', $productSize)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            $this->rating = $existingReview->rating;
            $this->review = $existingReview->review;
            $this->isSubmitted = true;
        }
    }

    public function setRating($rating)
    {
        if (!$this->isSubmitted) {
            $this->rating = $rating;
        }
    }

    public function submitReview()
    {
        if ($this->isSubmitted) {
            return;
        }

        $this->validate();

        ReviewProduct::create([
            'user_id' => Auth::id(),
            'transaction_token' => $this->transactionToken,
            'product_id' => $this->productId,
            'product_size' => $this->productSize,
            'rating' => $this->rating,
            'review' => $this->review,
        ]);

        $this->isSubmitted = true;
        session()->flash('review_success', 'Review submitted successfully!');
    }

    public function render()
    {
        return view('bootstrap.livewire.product-review-form');
    }
}
