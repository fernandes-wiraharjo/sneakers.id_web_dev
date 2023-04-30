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
                <div class="mr-5 ml-5 mt-3 p-2 mb-2 text-center">
                    @livewire('product-image', ['image' => $product->images()->get('image_url')->toArray(),'module' => 'products/'.$product->product_code, 'edit' => false, 'main_image' => $product->image ?? ''])
                </div>
                <hr>

                <form action="{{ route('administrator.product.store') }}" method="post" id="form"
                    enctype="multipart/form-data">
                    @csrf

                    @include('product::_partials._form', ['product' => $product, 'product_code' => $product_code, 'size' => $size,'edit' => false])


                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

</x-base-layout>
