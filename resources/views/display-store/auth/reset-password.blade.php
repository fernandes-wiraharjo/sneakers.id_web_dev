<x-customer-auth-layout>

    <div class="text-center mb-5">
        <h4 class="font-weight-bold">Reset Password</h4>
    </div>

    <form method="POST" action="{{ route('administrator.password.update') }}">
        @csrf

        <div class="my-3">
            <x-alert/>
        </div>

        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <x-ladmin-input name="password" type="password" placeholder="New Password" class="px-5" old="true" required="true">
                <x-slot name="prepend">
                    {!! ladmin()->icon('lock-open') !!}
                </x-slot>
            </x-ladmin-input>
        </div>
        <div class="fv-row mb-5">
            <x-ladmin-input name="password_confirmation" type="password" placeholder="Confirm Password" class="px-5" old="true" required="true">
                <x-slot name="prepend">
                    {!! ladmin()->icon('lock-closed') !!}
                </x-slot>
            </x-ladmin-input>
        </div>

        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>

</x-customer-auth-layout>
