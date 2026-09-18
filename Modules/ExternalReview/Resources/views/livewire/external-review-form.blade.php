<div class="review-form-container">
    @if (session()->has('review_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('review_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('review_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('review_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <input type="hidden" id="rating-input-external" value="{{ $rating }}">
        <div class="d-flex gap-2 rating-stars" data-form-id="external">
            @for ($i = 1; $i <= 5; $i++)
                <button
                    type="button"
                    class="btn btn-link p-0 border-0 rating-star {{ $rating >= $i ? 'text-warning' : 'text-secondary' }}"
                    data-rating="{{ $i }}"
                    @if($isSubmitted) disabled @endif
                    style="font-size: 1.5rem; text-decoration: none;">
                    <span class="iconify" data-icon="material-symbols:star"></span>
                </button>
            @endfor
        </div>
        @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <textarea
            class="form-control"
            id="review-external"
            rows="4"
            wire:model.defer="review"
            @if($isSubmitted) disabled @endif
            placeholder="Write your review here (minimum 10 characters)..."></textarea>
        @error('review') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <button
        type="button"
        class="btn btn-dark w-100"
        id="submit-review-external"
        @if($isSubmitted) disabled @endif>
        @if($isSubmitted)
            <span class="iconify me-2" data-icon="material-symbols:check-circle"></span>
            Review Submitted
        @else
            Submit Review
        @endif
    </button>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        var ratingInput = $('#rating-input-external');
        var stars = $('.rating-stars[data-form-id="external"] .rating-star');

        stars.on('click', function() {
            if ($(this).prop('disabled')) {
                return;
            }

            var selectedRating = parseInt($(this).data('rating'));
            ratingInput.val(selectedRating);

            stars.each(function(index) {
                var starRating = index + 1;
                if (starRating <= selectedRating) {
                    $(this).removeClass('text-secondary').addClass('text-warning');
                } else {
                    $(this).removeClass('text-warning').addClass('text-secondary');
                }
            });
        });

        $('#submit-review-external').on('click', function() {
            var rating = parseInt(ratingInput.val()) || 0;
            @this.set('rating', rating);
            @this.call('submitReview');
        });
    });
</script>
@endpush
