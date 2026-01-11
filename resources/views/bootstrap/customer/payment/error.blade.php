@extends('bootstrap.layout')

@section('title', 'Payment Error')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="alert alert-danger text-center">
                <h4 class="alert-heading">Payment Error</h4>
                <p>There was an error processing your payment. Please try again.</p>
                <hr>
                <p class="mb-0">
                    <a href="{{ route('customer.cart') }}" class="btn btn-danger">Return to Cart</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Redirect to cart after 5 seconds
    setTimeout(function() {
        window.location.href = '{{ route('customer.cart') }}';
    }, 5000);
</script>
@endsection

