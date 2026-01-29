<div class="review-form-container">
    @if (session()->has('review_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('review_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3">
        <input type="hidden" id="rating-input-{{ $productId }}-{{ $productSize }}" value="{{ $rating }}">
        <div class="d-flex gap-2 rating-stars" data-form-id="{{ $productId }}-{{ $productSize }}">
            @for ($i = 1; $i <= 5; $i++)
                <button 
                    type="button" 
                    wire:key="rating-{{ $i }}"
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
            id="review-{{ $productId }}-{{ $productSize }}"
            rows="4" 
            wire:model.defer="review"
            @if($isSubmitted) disabled @endif
            placeholder="Write your review here (minimum 10 characters)..."></textarea>
        @error('review') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <button 
        type="button" 
        class="btn btn-dark w-100"
        id="submit-review-{{ $productId }}-{{ $productSize }}"
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
        var formId = '{{ $productId }}-{{ $productSize }}';
        var ratingInput = $('#rating-input-' + formId);
        var stars = $('.rating-stars[data-form-id="' + formId + '"] .rating-star');
        var submitButton = $('button[wire\\:click="submitReview"]');

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

        // Handle submit button click
        $('#submit-review-' + formId).on('click', function() {
            var rating = parseInt(ratingInput.val()) || 0;
            @this.set('rating', rating);
            @this.call('submitReview');
        });
    });
</script>
@endpush

