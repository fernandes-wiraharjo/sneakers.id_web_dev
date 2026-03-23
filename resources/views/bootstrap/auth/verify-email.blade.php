@extends('bootstrap.layout-minimal')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ $auth_page_side_image_mobile }}" alt="Verify Email" class="img-fluid">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ $logo_navbar }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Email Verification</p>
            <h1 class="display-5 fw-bold">Verify Your Email</h1>
            <p class="text-muted mb-3 mb-md-4">Before proceeding, please check your email for a verification link.</p>

            <div class="alert alert-info">
                <p class="mb-0">{{ __('If you did not receive the email') }}, click the button below to request another verification email.</p>
            </div>

            <form method="POST" action="{{ route('customer.user.verify', $token) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-4">
                    {{ __('Click here to request another') }}
                </button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    <a href="{{ route('customer.login') }}" class="fw-bold">Kembali ke Login</a>
                </p>
                <p class="mt-2">
                    <a href="/" class="fw-bold">Kembali ke Store</a>
                </p>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ $auth_page_side_image_website }}" alt="Verify Email" class="w-100">
        </div>
    </div>
</div>
@endsection

