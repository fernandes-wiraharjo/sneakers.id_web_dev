<x-base-layout>
    <x-slot name="styles">
        {{--
        <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Product</h1>
    </x-slot>

    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">

            <form action="{{ route('administrator.product.update', $product->id) }}" method="post" id="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('product::_partials._form', ['product' => $product, 'product_code' => $product->product_code, 'edit' => true])

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">
                            Update
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
