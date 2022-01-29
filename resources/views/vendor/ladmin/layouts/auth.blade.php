<x-auth-layout>

    <!--begin::Signin Form-->
    <form method="POST"  action="{{ route('login') }}" class="form w-100" novalidate="novalidate"
        id="kt_sign_in_form">
        @csrf

        <!--begin::Heading-->
        <div class="text-center mb-10">
            @if (config('ladmin.logo'))
                <img src="{{ config('ladmin.logo') }}" alt="Logo" width="150">
            @else
                {{ config('app.name') }}
            @endif
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Sign In to Sneaker.id ') }}
            </h1>
            <!--end::Title-->
        </div>
        <!--begin::Heading-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off"
                value="{{ old('email', 'demo@demo.com') }}" required autofocus />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                <!--end::Label-->
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                autocomplete="off" value="demo" required />
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


    </form>
    <!--end::Signin Form-->

</x-auth-layout>
