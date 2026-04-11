@extends('bootstrap.layout-minimal')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ $auth_page_side_image_mobile }}" alt="Login" class="w-100">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ $logo_navbar }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Login Sneakers Account</p>
            <h1 class="display-5 fw-bold">Welcome</h1>
            <p class="text-muted mb-3 mb-md-4">Enter your Email and Password to login</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <p class="mb-2">Email</p>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email">
                
                <p class="mt-3 mt-md-4 mb-2">Password</p>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-5">Masuk</button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    Belum punya akun? <a href="{{ route('customer.register') }}" class="fw-bold">Daftar Sekarang</a>
                </p>
                <a href="{{ route('customer.forgot-password') }}" class="fw-bold">Lupa Password</a>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ $auth_page_side_image_website }}" alt="Login" class="w-100">
        </div>
    </div>
</div>
@endsection