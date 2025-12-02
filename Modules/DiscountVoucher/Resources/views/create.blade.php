<x-base-layout>
    <x-slot name="styles">
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Create Discount Voucher</h1>
    </x-slot>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <form action="{{ route('administrator.discount-voucher.store') }}" method="post" id="form">
                @csrf

                @include('discountvoucher::_partials._form', ['voucher' => $voucher, 'voucher_code' => $voucher_code, 'edit' => false])

                <div class="text-right">
                    <a href="{{ route('administrator.discount-voucher.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

</x-base-layout>

