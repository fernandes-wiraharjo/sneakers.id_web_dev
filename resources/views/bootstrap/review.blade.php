@extends('bootstrap.layout')

@section('title', 'Write Review - SNEAKERS.ID')

@push('styles')
<style>
    .product-review-card {
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        background: #fff;
    }
    .product-info {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }
    .product-image-wrapper {
        width: 120px;
        height: 120px;
        flex-shrink: 0;
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .product-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .product-details h5 {
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    .product-details p {
        margin-bottom: 0.25rem;
        color: #6c757d;
    }
    @media (max-width: 768px) {
        .product-info {
            flex-direction: column;
        }
        .product-image-wrapper {
            width: 100%;
            height: auto;
            aspect-ratio: 1;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center">
            <a href="{{ route('customer.transaction.detail', $transaction->token) }}" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <div>
                <h1 class="fw-bold mb-0">Write Review</h1>
                <p class="text-muted mb-0">Order #{{ strtoupper($transaction->token) }}</p>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($items as $item)
            @php
                $product = $item->detail->product;
                $productSize = $item->detail->size;
                $reviewKey = $product->id . '_' . $productSize;
                $existingReview = $reviews->get($reviewKey);
                $reviewSubmitted = $existingReview ? true : false;
            @endphp
            
            <div class="col-12">
                <div class="product-review-card">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="product-info">
                                <div class="product-image-wrapper">
                                    <img src="{{ getImage($product->image, 'products/'.$product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid">
                                </div>
                                <div class="product-details">
                                    <h5>{{ $product->product_name }}</h5>
                                    <p class="mb-1"><strong>Size:</strong> {{ $productSize }}</p>
                                    <p class="mb-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                    <p class="mb-0 text-muted">{{ $product->product_code }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="review-section">
                                @if($reviewSubmitted)
                                    <div class="alert alert-info">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="iconify me-2" data-icon="material-symbols:check-circle" style="font-size: 1.5rem;"></span>
                                            <strong>Review Submitted</strong>
                                        </div>
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="iconify {{ $existingReview->rating >= $i ? 'text-warning' : 'text-secondary' }}" data-icon="material-symbols:star" style="font-size: 1.25rem;"></span>
                                            @endfor
                                        </div>
                                        <p class="mb-0">{{ $existingReview->review }}</p>
                                    </div>
                                @else
                                    @livewire('product-review-form', [
                                        'transactionToken' => $transaction->token,
                                        'productId' => $product->id,
                                        'productSize' => $productSize,
                                        'productName' => $product->product_name,
                                        'productImage' => getImage($product->image, 'products/'.$product->product_code),
                                        'productCode' => $product->product_code
                                    ])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

