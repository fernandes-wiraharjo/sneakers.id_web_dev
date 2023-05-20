<x-customer-auth-layout>

    <!--begin::Signin Form-->
    <form method="POST"  action="{{ route('login') }}" class="form w-100" novalidate="novalidate"
        id="kt_sign_in_form">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Sign In to '. config('app.name')) }}
            </h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">New Here?
                <a href="{{ route('customer.register') }}" class="link-primary fw-bolder">Create an Account</a>
            </div>
                <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <div class="fv-row mb-10 my-3">
            <x-ladmin-alert />

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off"
                required autofocus />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                <a href="{{ route('customer.forgot-password') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                autocomplete="off" required />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="remember" />
                <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Remember me') }}
                </span>
            </label>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                @include('back-office.partials.general._button-indicator', ['label' => __('Continue')])
            </button>
            <!--end::Submit button-->

        </div>
        <!--end::Actions-->


    </form>
    <!--end::Signin Form-->

</x-customer-auth-layout>
