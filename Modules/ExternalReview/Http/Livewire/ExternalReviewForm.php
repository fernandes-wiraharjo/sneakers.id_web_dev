<?php

namespace Modules\ExternalReview\Http\Livewire;

use App\Models\ReviewProduct;
use Livewire\Component;
use Modules\ExternalReview\Repositories\ExternalReviewRepository;

class ExternalReviewForm extends Component
{
    public $token;
    public $rating = 0;
    public $review = '';
    public $isSubmitted = false;

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

    public function mount($token)
    {
        $this->token = $token;

        $repository = app(ExternalReviewRepository::class);
        $link = $repository->getByToken($token);

        if ($link && $link->isUsed() && $link->reviewProduct) {
            $this->rating = $link->reviewProduct->rating;
            $this->review = $link->reviewProduct->review;
            $this->isSubmitted = true;
        }
    }

    public function submitReview()
    {
        if ($this->isSubmitted) {
            return;
        }

        $repository = app(ExternalReviewRepository::class);
        $link = $repository->getByToken($this->token);

        if (! $link || ! $link->product) {
            session()->flash('review_error', 'This review link is invalid.');

            return;
        }

        if ($link->isUsed()) {
            session()->flash('review_error', 'This review link has already been used.');

            return;
        }

        $this->validate();

        $reviewProduct = ReviewProduct::create([
            'user_id' => null,
            'transaction_token' => null,
            'reviewer_name' => $link->buyer_name,
            'product_id' => $link->product_id,
            'product_size' => $link->product_size,
            'rating' => $this->rating,
            'review' => $this->review,
        ]);

        $repository->markAsUsed($link, $reviewProduct->id);

        $this->isSubmitted = true;
        session()->flash('review_success', 'Review submitted successfully!');
    }

    public function render()
    {
        return view('externalreview::livewire.external-review-form');
    }
}
