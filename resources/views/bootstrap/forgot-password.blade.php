@extends('bootstrap.layout-minimal')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ asset('stores-info/login-img.webp') }}" alt="Forgot Password" class="img-fluid">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ asset('stores-info/logo-black-new.png') }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Reset Password</p>
            <h1 class="display-5 fw-bold">Forgot Password</h1>
            <p class="text-muted mb-3 mb-md-4">Enter your email address and we'll send you a link to reset your password</p>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ is_array($message) ? (isset($message[0]) ? (is_array($message[0]) ? implode(', ', $message[0]) : $message[0]) : implode(', ', $message)) : $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ is_array($message) ? (isset($message[0]) ? (is_array($message[0]) ? implode(', ', $message[0]) : $message[0]) : implode(', ', $message)) : $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('administrator.password.email') }}" id="forgotPasswordForm">
                @csrf
                <p class="mb-2">Email<span class="text-danger">*</span></p>
                <input type="email" 
                       name="email" 
                       id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Masukkan Email"
                       value="{{ old('email') }}"
                       required 
                       autofocus>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-5">
                    Kirim Email Reset Password
                </button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    Sudah ingat passwordnya? <a href="{{ route('customer.login') }}" class="fw-bold">Login Sekarang</a>
                </p>
                <p class="mt-2">
                    Belum punya akun? <a href="{{ route('customer.register') }}" class="fw-bold">Daftar Sekarang</a>
                </p>
                <p class="mt-5">
                    <a href="/" class="fw-bold">Kembali ke Store</a>
                </p>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ asset('stores-info/login-img-md.webp') }}" alt="Forgot Password" class="w-100">
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

        // Email validation function
        function validateEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Form submission handler
        $('#forgotPasswordForm').on('submit', function(e) {
            var email = $('#email').val().trim();
            
            // Clear previous errors
            $('#email').removeClass('is-invalid');
            $('#email').siblings('.text-danger').hide();

            // Validate Email
            if (email === '') {
                e.preventDefault();
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="text-danger small mt-1">Email wajib diisi</div>');
                return false;
            } else if (!validateEmail(email)) {
                e.preventDefault();
                $('#email').addClass('is-invalid');
                $('#email').after('<div class="text-danger small mt-1">Format email tidak valid</div>');
                return false;
            }
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

