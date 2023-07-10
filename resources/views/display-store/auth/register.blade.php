<x-customer-auth-layout >
    <div style="width: 360px;text-align-last: center;padding: 6% 0 6%; margin:auto;">
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Register to '. config('app.name')) }}
            </h1>
            <!--end::Title-->
        </div>

        <!--begin::Heading-->
        <div class="fv-row mb-10 my-3">
            <x-alert/>
        </div>

        <form action="{{ route('customer.submit.register') }}" method="post">
            @csrf

            @include('display-store.auth._partials._form-register', ['user' => app(config('ladmin.user',
            App\Models\User::class))])

            <!--begin::Actions-->
            <div style="text-align: -webkit-center;">
                <!--begin::Submit button-->
                <button type="submit" id="kt_sign_in_submit" class="Form__Submit Button Button--primary Button--full">
                    Register
                </button>
                <!--end::Submit button-->
            </div>
            <!--end::Actions-->
            <!--begin::Link-->
            <div class="">Have an account ?
                <a href="{{ route('customer.login') }}" class=""><strong>Sign in</strong></a>
            </div>
                <!--end::Link-->
        </form>
    </div>
</x-customer-auth-layout>
