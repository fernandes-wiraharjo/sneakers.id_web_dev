<x-base-layout>
    @if (!auth()->user()->is_email_verified)
        <!--begin::Alert-->
        <div class="alert alert-danger d-flex align-items-center p-5">
            <!--begin::Icon-->
            <i class="fas fa-exclamation-circle fs-2hx text-danger me-4"></i>
            <!--end::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h4 class="mb-1 text-dark">Verification your email!</h4>
                <!--end::Title-->

                <!--begin::Content-->
                <span>Thank you for signing up for our service! To ensure the security and validity of your account, we kindly request you to verify your email address.
                    <span><a href="{{ route('customer.verify-email', $token) }}">here</a></span>.
                </span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
    @endif
</x-base-layout>
