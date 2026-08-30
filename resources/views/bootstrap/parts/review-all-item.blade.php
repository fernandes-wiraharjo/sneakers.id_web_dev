<div class="card rounded-4 border-0 shadow">
    <div class="card-body p-4">
        <div class="row g-3 align-items-start">
            @if($review->product)
                <div class="col-auto">
                    <a href="{{ route('product-detail', [$review->product_id, \Illuminate\Support\Str::slug($review->product->product_name)]) }}">
                        <img
                            src="{{ getImage($review->product->image, 'products/' . $review->product->product_code) }}"
                            alt="{{ $review->product->product_name }}"
                            class="rounded-3"
                            style="width: 80px; height: 80px; object-fit: cover;">
                    </a>
                </div>
            @endif
            <div class="col">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-1">
                    <div>
                        <p class="fw-bold mb-1">{{ $review->reviewer_name }}</p>
                        @if($review->product)
                            <a href="{{ route('product-detail', [$review->product_id, \Illuminate\Support\Str::slug($review->product->product_name)]) }}"
                                class="text-muted text-decoration-none">
                                {{ $review->created_at->format('d/m/Y') }}
                                |
                                {{ $review->product->product_name }}
                                @if($review->product_size)
                                    · Size {{ $review->product_size }}
                                @endif
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mb-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="iconify fs-5 lh-1 {{ $review->rating >= $i ? 'text-warning' : 'text-secondary' }}" data-icon="material-symbols:star"></span>
                    @endfor
                </div>
                <p class="text-secondary mb-0">{{ $review->review }}</p>
            </div>
        </div>
    </div>
</div>
