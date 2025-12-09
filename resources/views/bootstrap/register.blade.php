@extends('bootstrap.layout-minimal')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-md-none px-0">
            <img src="{{ asset('stores-info/login-img.webp') }}" alt="Login" class="img-fluid">
        </div>
        <div class="col-12 col-md-6 p-4 p-md-5">
            <img src="{{ asset('stores-info/logo-black-new.png') }}" alt="">
            <p class="mt-3 mt-md-4 fw-bold">Login Sneakers Account</p>
            <h1 class="display-5 fw-bold">Welcome</h1>
            <p class="text-muted mb-3 mb-md-4">Enter your Email and Password to login</p>

            <form action="{{ route('customer.submit.register') }}" method="POST" id="registerForm">
                @csrf
                <p class="mb-2">Nama Depan<span class="text-danger">*</span></p>
                <input value="{{ old('first_name') }}" type="text" name="first_name" id="first_name" class="form-control" placeholder="Nama Depan">
                <div class="error-message text-danger small" id="first_name_error"></div>
                
                <p class="mt-3 mt-md-4 mb-2">Nama Belakang<span class="text-danger">*</span></p>
                <input value="{{ old('last_name') }}" type="text" name="last_name" id="last_name" class="form-control" placeholder="Nama Belakang">
                <div class="error-message text-danger small" id="last_name_error"></div>
                
                <p class="mt-3 mt-md-4 mb-2">Email<span class="text-danger">*</span></p>
                <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control" placeholder="Alamat Email">
                <div class="error-message text-danger small" id="email_error"></div>
                
                <p class="mt-3 mt-md-4 mb-2">Password<span class="text-danger">*</span></p>
                <p class="text-muted">Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka</p>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
                <div class="error-message text-danger small" id="password_error"></div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mt-3" placeholder="Konfirmasi Password">
                <div class="error-message text-danger small" id="password_confirmation_error"></div>
                <button type="submit" class="btn btn-dark rounded-pill w-100 mt-3 mt-md-5">Daftar</button>
            </form>

            <div class="text-center">
                <p class="mt-3 mt-md-4">
                    Sudah memiliki akun? <a href="{{ route('customer.login') }}" class="fw-bold">Login Sekarang</a>
                </p>
            </div>
        </div>
        <div class="d-none d-md-block col-6 pe-0 ps-5">
            <img src="{{ asset('stores-info/login-img-md.webp') }}" alt="Login" class="w-100">
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Clear error messages on input
        $('input').on('input', function() {
            var fieldName = $(this).attr('id');
            $('#' + fieldName + '_error').text('').hide();
            $(this).removeClass('is-invalid');
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

        // Email validation function
        function validateEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Form submission handler
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            
            var isValid = true;
            var errors = {};

            // Clear previous errors
            $('.error-message').text('').hide();
            $('input').removeClass('is-invalid');

            // Validate First Name
            var firstName = $('#first_name').val().trim();
            if (firstName === '') {
                errors.first_name = 'Nama depan wajib diisi';
                isValid = false;
            }

            // Validate Last Name
            var lastName = $('#last_name').val().trim();
            if (lastName === '') {
                errors.last_name = 'Nama belakang wajib diisi';
                isValid = false;
            }

            // Validate Email
            var email = $('#email').val().trim();
            if (email === '') {
                errors.email = 'Email wajib diisi';
                isValid = false;
            } else if (!validateEmail(email)) {
                errors.email = 'Format email tidak valid';
                isValid = false;
            }

            // Validate Password
            var password = $('#password').val();
            if (password === '') {
                errors.password = 'Password wajib diisi';
                isValid = false;
            } else {
                var passwordErrors = validatePassword(password);
                if (passwordErrors.length > 0) {
                    errors.password = passwordErrors.join(', ');
                    isValid = false;
                }
            }

            // Validate Password Confirmation
            var passwordConfirmation = $('#password_confirmation').val();
            if (passwordConfirmation === '') {
                errors.password_confirmation = 'Konfirmasi password wajib diisi';
                isValid = false;
            } else if (password !== passwordConfirmation) {
                errors.password_confirmation = 'Konfirmasi password tidak cocok';
                isValid = false;
            }

            // Display errors
            if (!isValid) {
                $.each(errors, function(field, message) {
                    var fieldId = field;
                    if (field === 'first_name') fieldId = 'first_name';
                    else if (field === 'last_name') fieldId = 'last_name';
                    else if (field === 'email') fieldId = 'email';
                    else if (field === 'password') fieldId = 'password';
                    else if (field === 'password_confirmation') fieldId = 'password_confirmation';
                    
                    $('#' + fieldId + '_error').text(message).show();
                    $('#' + fieldId).addClass('is-invalid');
                });
                return false;
            }

            // If validation passes, submit the form
            this.submit();
        });
    });
</script>
<style>
    .error-message {
        display: none;
        margin-top: 0.25rem;
        font-size: 0.875rem;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>
@endpush