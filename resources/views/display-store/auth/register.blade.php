<x-customer-auth-layout >

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
        <x-ladmin-alert />
    </div>

    <form action="{{ route('customer.submit.register') }}" method="post">
        @csrf

        @include('vendor.ladmin.user._partials._form-register', ['user' => app(config('ladmin.user',
        App\Models\User::class))])

        <div class="text-center">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </form>
</x-customer-auth-layout>
