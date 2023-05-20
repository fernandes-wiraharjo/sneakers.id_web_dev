<x-customer-auth-layout>
    <div class="text-center mb-5">
        <h4 class="font-weight-bold">Reset Password</h4>
    </div>

    <form method="POST" action="{{ route('administrator.password.email') }}" class="form w-100">
        @csrf

        <div class="my-3">
            <x-ladmin-alert />
        </div>

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <x-ladmin-input name="email" type="email" placeholder="Email Address" class="px-5" old="true" required="true">
                <x-slot name="prepend">
                    {!! ladmin()->icon('at-symbol') !!}
                </x-slot>
            </x-ladmin-input>
        </div>

        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit"  class="btn btn-lg btn-primary w-100 mb-5">
                @include('back-office.partials.general._button-indicator', ['label' => __('Send Password Reset Link')])
            </button>
            <!--end::Submit button-->

        </div>
        <!--end::Actions-->
    </form>

</x-customer-auth-layout>
