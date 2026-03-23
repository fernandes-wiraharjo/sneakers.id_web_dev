@extends('bootstrap.layout')

@section('title', 'Payment Error - SNEAKERS.ID')

@push('styles')
<style>
    .error-icon {
        width: 80px;
        height: 80px;
        background-color: #f8d7da;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    .error-icon svg {
        width: 50px;
        height: 50px;
        color: #842029;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card text-center">
                <div class="card-body py-5">
                    <div class="error-icon">
                        <span class="iconify" data-icon="material-symbols:error" style="font-size: 50px; color: #842029;"></span>
                    </div>
                    <h1 class="fw-bold mb-3">Payment Error</h1>
                    <p class="text-muted mb-4">
                        There was an error processing your payment. Please try again or contact us if the problem persists.
                    </p>
                    <div class="alert alert-info">
                        <p class="mb-0">You will be redirected to your cart in <span id="countdown">5</span> seconds...</p>
                    </div>
                    <div class="d-flex gap-3 justify-content-center mt-4">
                        <a href="{{ route('customer.cart') }}" class="btn btn-dark">
                            Return to Cart
                        </a>
                        <a href="{{ route('store') }}" class="btn btn-outline-dark">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let countdown = 5;
    const countdownElement = document.getElementById('countdown');
    
    const interval = setInterval(function() {
        countdown--;
        if (countdownElement) {
            countdownElement.textContent = countdown;
        }
        if (countdown <= 0) {
            clearInterval(interval);
            window.location.href = "{{ route('customer.cart') }}";
        }
    }, 1000);
</script>
@endpush
@endsection

