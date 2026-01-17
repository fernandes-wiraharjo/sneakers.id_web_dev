@extends('bootstrap.layout-minimal')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ asset('stores-info/login-img.webp') }}" alt="Reset Password" class="img-fluid">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ asset('stores-info/logo-black-new.png') }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Reset Password</p>
            <h1 class="display-5 fw-bold">New Password</h1>
            <p class="text-muted mb-3 mb-md-4">Enter your new password below</p>

            <form method="POST" action="{{ route('administrator.password.update') }}" id="resetPasswordForm">
                @csrf

                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <p class="mb-2">New Password<span class="text-danger">*</span></p>
                <p class="text-muted small">Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka</p>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Masukkan Password Baru"
                       required 
                       autofocus>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                <p class="mt-3 mt-md-4 mb-2">Confirm Password<span class="text-danger">*</span></p>
                <input type="password" 
                       name="password_confirmation" 
                       id="password_confirmation" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       placeholder="Konfirmasi Password"
                       required>
                @error('password_confirmation')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-5">
                    Reset Password
                </button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    Sudah ingat passwordnya? <a href="{{ route('customer.login') }}" class="fw-bold">Login Sekarang</a>
                </p>
                <p class="mt-2">
                    <a href="/" class="fw-bold">Kembali ke Store</a>
                </p>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ asset('stores-info/login-img-md.webp') }}" alt="Reset Password" class="w-100">
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

        // Password validation function
        function validatePassword(password) {
            var errors = [];
            
            if (password.length < 8) {
                errors.push('Password minimal 8 karakter');
            }
            if (!/[A-Z]/.test(password)) {
                errors.push('Password harus mengandung huruf besar');
            }
            if (!/[a-z]/.test(password)) {
                errors.push('Password harus mengandung huruf kecil');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('Password harus mengandung angka');
            }
            
            return errors;
        }

        // Form submission handler
        $('#resetPasswordForm').on('submit', function(e) {
            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();
            
            // Clear previous errors
            $('#password').removeClass('is-invalid');
            $('#password_confirmation').removeClass('is-invalid');
            $('#password').siblings('.text-danger').hide();
            $('#password_confirmation').siblings('.text-danger').hide();

            // Validate Password
            if (password === '') {
                e.preventDefault();
                $('#password').addClass('is-invalid');
                $('#password').after('<div class="text-danger small mt-1">Password wajib diisi</div>');
                return false;
            } else {
                var passwordErrors = validatePassword(password);
                if (passwordErrors.length > 0) {
                    e.preventDefault();
                    $('#password').addClass('is-invalid');
                    $('#password').after('<div class="text-danger small mt-1">' + passwordErrors.join(', ') + '</div>');
                    return false;
                }
            }

            // Validate Password Confirmation
            if (passwordConfirmation === '') {
                e.preventDefault();
                $('#password_confirmation').addClass('is-invalid');
                $('#password_confirmation').after('<div class="text-danger small mt-1">Konfirmasi password wajib diisi</div>');
                return false;
            } else if (password !== passwordConfirmation) {
                e.preventDefault();
                $('#password_confirmation').addClass('is-invalid');
                $('#password_confirmation').after('<div class="text-danger small mt-1">Konfirmasi password tidak cocok</div>');
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

