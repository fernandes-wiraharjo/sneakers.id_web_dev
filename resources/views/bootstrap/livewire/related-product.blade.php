<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-6">
            <h2 class="fw-bold mb-4">Related Products</h2>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{ route('collections', 'all') }}" class="d-flex gap-2 align-items-center justify-content-end">
                <span>VIEW ALL</span>
                <span class="iconify fs-3" data-icon="stash:arrow-right-duotone"></span>
            </a>
        </div>
    </div>
    <div class="row">
    @if($relatedProducts && $relatedProducts->count() > 0)
        @foreach($relatedProducts as $item)
            <div class="col-6 col-md-2 mt-2">
                @include('bootstrap.parts.product-card', ['item' => $item])
            </div>
        @endforeach
    @else
        <div class="col-12 py-5">
            <h2 class="fw-bold mb-4 text-center">No related products found</h2>
        </div>
    @endif
    </div>
</div>