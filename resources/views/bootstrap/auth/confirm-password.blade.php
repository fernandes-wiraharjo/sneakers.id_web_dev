@extends('bootstrap.layout-minimal')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ $auth_page_side_image_mobile }}" alt="Confirm Password" class="w-100">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ $logo_navbar }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Security Check</p>
            <h1 class="display-5 fw-bold">Confirm Password</h1>
            <p class="text-muted mb-3 mb-md-4">Please confirm your password before continuing</p>

            <form method="POST" action="{{ route('customer.password.confirm') }}" id="confirmPasswordForm">
                @csrf
                <p class="mb-2">Password<span class="text-danger">*</span></p>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan Password"
                       required 
                       autofocus>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-5">
                    Confirm Password
                </button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    <a href="{{ route('customer.forgot-password') }}" class="fw-bold">Lupa Password?</a>
                </p>
                <p class="mt-2">
                    <a href="/" class="fw-bold">Kembali ke Store</a>
                </p>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ $auth_page_side_image_website }}" alt="Confirm Password" class="w-100">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Clear error messages on input
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
            $(this).siblings('.text-danger').hide();
        });
    });
</script>
<style>
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
@endpush

