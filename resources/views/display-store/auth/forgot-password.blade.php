<x-customer-auth-layout>
    <div style="width: 360px;text-align-last: center;padding: 6% 0 6%; margin:auto;">
        <div class="text-center mb-5">
            <h1 style="font-weight: 300;">Reset Password</h1>
        </div>

        <form method="POST" action="{{ route('administrator.password.email') }}" class="form w-100">
            @csrf

            <div class="my-3">
                <x-alert/>
            </div>

            <!--begin::Input group-->
            <div style="padding: 10px 0px;">
                <!--begin::Label-->
                <label class="Heading u-h6">{{ __('Email') }}</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input class="Form__Input" type="email" name="email" autocomplete="off" placeholder="Email Address"
                    required autofocus />
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Actions-->
            <div style="text-align: -webkit-center;">
                <!--begin::Submit button-->
                <button type="submit" id="kt_sign_in_submit" class="Form__Submit Button Button--primary Button--full"> Send Password Reset Link
                    {{-- @include('back-office.partials.general._button-indicator', ['label' => __('Continue')]) --}}
                </button>
                <!--end::Submit button-->
            </div>
            <!--end::Actions-->

        </form>
    </div>

</x-customer-auth-layout>
