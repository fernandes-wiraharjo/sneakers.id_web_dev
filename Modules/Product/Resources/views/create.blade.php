<x-base-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Create Product</h1>
    </x-slot>

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-6">
                <form action="{{ route('administrator.product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @include('product::_partials._form', ['product' => $product, 'product_code' => $product_code])

            </div>
            <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Submit Product
                    </button>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

</x-base-layout>
