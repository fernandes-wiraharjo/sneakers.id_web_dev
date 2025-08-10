<x-customer-auth-layout>
    <div style="width: 360px;text-align-last: center;padding: 6% 0 6%; margin:auto;">

    <!--begin::Heading-->
    <div class="text-center mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3">
            Reset Password
        </h1>
        <!--end::Title-->
    </div>

    <!--begin::Heading-->
    <div class="fv-row mb-10 my-3">
        <x-alert/>
    </div>

    <form method="POST" action="{{ route('administrator.password.update') }}">
        @csrf

        <!--begin::Input group-->
        <div style="padding: 10px 10px;">
            <!--begin::Label-->
            <label class="Heading u-h6">{{ __('Current Password') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input name="password" type="password" placeholder="New Password" class="Form__Input" required>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div style="padding: 10px 10px;">
            <!--begin::Label-->
            <label class="Heading u-h6">{{ __('Password Confirmation') }}</label>
            <!--end::Label-->

            <!--begin::Input-->
            <input name="password_confirmation" type="password" placeholder="Confirm Password" class="Form__Input" required>
            <!--end::Input-->
        </div>
        <!--end::Input group-->

        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <!--begin::Actions-->
        <div style="text-align: -webkit-center;">
            <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="Form__Submit Button Button--primary Button--full">
                Reset Password
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
    </form>
</div>
</x-customer-auth-layout>
