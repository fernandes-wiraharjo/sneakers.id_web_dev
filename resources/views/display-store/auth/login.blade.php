<x-customer-auth-layout>
    <div style="width: 360px;text-align-last: center;padding: 6% 0 6%; margin:auto;">

    <!--begin::Signin Form-->
    <form method="POST"  action="{{ route('login') }}" novalidate="novalidate"
        id="kt_sign_in_form">
        @csrf

        <!--begin::Heading-->
        <div>
            <!--begin::Title-->
            <h1 class="">
                {{ __('Sign In to '. config('app.name')) }}
            </h1>
            <!--end::Title-->
        </div>
        <!--begin::Heading-->
        <div class="">
            <x-alert/>
        </div>
        <!--begin::Input group-->
        <div style="padding: 10px 0px;">
            <!--begin::Label-->
            <label class="Heading u-h6">{{ __('Email') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input class="Form__Input" type="email" name="email" autocomplete="off"
                required autofocus />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div style="padding: 10px 0px;">
            <!--begin::Wrapper-->
            <div class="">
                <!--begin::Label-->
                <label class="Heading u-h6">{{ __('Password') }}</label>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Input-->
            <input class="Form__Input" type="password" name="password"
            autocomplete="off" required />
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        {{-- <div class="">
            <label class="">
                <input class="" type="checkbox" name="remember" />
                <span class=" fw-bold text-gray-700 fs-6">{{ __('Remember me') }}
                </span>
            </label>
        </div> --}}
        <a href="{{ route('customer.forgot-password') }}" class="l">Forgot Password ?</a>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div style="text-align: -webkit-center;">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="Form__Submit Button Button--primary Button--full"> Continue
                {{-- @include('back-office.partials.general._button-indicator', ['label' => __('Continue')]) --}}
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
        <!--begin::Link-->
        <div class="">Don't have account ?
            <a href="{{ route('customer.register') }}" class=""><strong>Create one</strong></a>
        </div>
            <!--end::Link-->


    </form>
    <!--end::Signin Form-->
    </div>
</x-customer-auth-layout>
