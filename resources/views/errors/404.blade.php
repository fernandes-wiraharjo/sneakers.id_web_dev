@extends('bootstrap.layout')

@section('title', '404 - Page Not Found')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-50">
        <div class="col-12 col-md-8 col-lg-6 text-center">
            <div class="mb-4">
                <img src="{{ asset('stores-info/product-not-found.webp') }}" alt="Page Not Found" class="img-fluid" style="max-width: 400px;">
            </div>
            <h1 class="display-1 fw-bold text-danger mb-3">404</h1>
            <h2 class="h3 fw-semibold mb-3">Page Not Found</h2>
            <p class="text-muted mb-4">Sorry, the page you are looking for does not exist or has been moved.</p>
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="{{ route('store') }}" class="btn btn-danger rounded-pill px-4">
                    <span class="iconify me-2" data-icon="majesticons:home-line"></span>
                    Go to Homepage
                </a>
                <button onclick="window.history.back()" class="btn btn-outline-dark rounded-pill px-4">
                    <span class="iconify me-2" data-icon="majesticons:arrow-left-line"></span>
                    Go Back
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

