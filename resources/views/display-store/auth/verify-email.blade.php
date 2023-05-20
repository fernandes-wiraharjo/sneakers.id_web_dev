<x-customer-auth-layout>
    <div class="text-center mb-5">
        <h4 class="font-weight-bold">Email Verification</h4>
    </div>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <div class="fv-row mb-5">

    </div>
    <form class="d-inline" method="POST" action="{{ route('customer.user.verify', $token) }}">
        @csrf
         <!--begin::Actions-->
        <div class="text-center">
        <!--begin::Submit button-->
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                @include('back-office.partials.general._button-indicator', ['label' => __('click here to request another')])
            </button>
        <!--end::Submit button-->
         </div>
    </form>
</x-customer-auth-layout>
