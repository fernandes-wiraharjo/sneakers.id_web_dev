@extends('bootstrap.layout')

@section('title', 'Checkout - SNEAKERS.ID')

@push('styles')
<style>
    .breadcrumb {
        align-items: center;
        justify-content: center;
    }

    .breadcrumb-item a {
        text-decoration: auto;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: var(--bs-breadcrumb-divider, ">");
    }

    @media screen and (max-width: 1000px) {
        .dh43e {
            padding: 0px 50px;
        }
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        border-top: 4px solid #3498db;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    @livewire('checkout-process')
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        console.log("Livewire is working");
    })
</script>
@endpush

