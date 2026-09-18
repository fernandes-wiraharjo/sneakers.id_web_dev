@extends('externalreview::layouts.review')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="text-center mb-4">
            <h1 class="fw-bold mb-1">Write Your Review</h1>
            <p class="text-muted mb-0">Thank you for shopping with SNEAKERS.ID</p>
        </div>

        <div class="product-review-card">
            <div class="row g-4">
                <div class="col-12 col-md-5">
                    <div class="d-flex gap-3 align-items-start">
                        <div class="product-image-wrapper">
                            <img src="{{ $productImage }}" alt="{{ $product->product_name }}" class="img-fluid">
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ $product->product_name }}</h5>
                            <p class="mb-1"><strong>Size:</strong> {{ $link->product_size }}</p>
                            <p class="mb-1"><strong>Reviewer:</strong> {{ $link->buyer_name }}</p>
                            <p class="mb-0 text-muted">{{ $product->product_code }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    @livewire('external-review-form', ['token' => $link->token])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
