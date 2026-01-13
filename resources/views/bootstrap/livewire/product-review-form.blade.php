<div class="review-form-container">
    @if (session()->has('review_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('review_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label fw-semibold">Rating</label>
        <div class="d-flex gap-2">
            @for ($i = 1; $i <= 5; $i++)
                <button 
                    type="button" 
                    class="btn btn-link p-0 border-0 {{ $rating >= $i ? 'text-warning' : 'text-secondary' }}"
                    wire:click="setRating({{ $i }})"
                    @if($isSubmitted) disabled @endif
                    style="font-size: 1.5rem; text-decoration: none;">
                    <span class="iconify" data-icon="material-symbols:star"></span>
                </button>
            @endfor
        </div>
        @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label for="review-{{ $productId }}-{{ $productSize }}" class="form-label fw-semibold">Review</label>
        <textarea 
            class="form-control" 
            id="review-{{ $productId }}-{{ $productSize }}"
            rows="4" 
            wire:model="review"
            @if($isSubmitted) disabled @endif
            placeholder="Write your review here (minimum 10 characters)..."></textarea>
        @error('review') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <button 
        type="button" 
        class="btn btn-dark w-100"
        wire:click="submitReview"
        @if($isSubmitted) disabled @endif>
        @if($isSubmitted)
            <span class="iconify me-2" data-icon="material-symbols:check-circle"></span>
            Review Submitted
        @else
            Submit Review
        @endif
    </button>
</div>

