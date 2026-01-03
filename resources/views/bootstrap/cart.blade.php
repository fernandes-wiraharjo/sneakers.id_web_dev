@extends('bootstrap.layout')

@section('title', "Your Shopping Cart")

@push('styles')
<style>
    .cart-item-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .quantity-btn {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        background: white;
        cursor: pointer;
        border-radius: 4px;
    }
    .quantity-btn:hover:not(:disabled) {
        background-color: #f8f9fa;
    }
    .quantity-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 4px 8px;
    }
    @media (max-width: 768px) {
        .cart-item-image {
            width: 80px;
            height: 80px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0">Shopping Cart</h1>
        </div>
        <div class="col-12">
            @livewire('cart-checkout')
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush

