<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">{{ $title ?? ''}}</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card mb-6">
        <!--begin::Card body-->
        <div class="card-body pt-6 d-flex flex-center flex-column p-9">
            <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{ $size->size_code ?? '' }}</a>
            <div class="fw-bold text-gray-400 mb-6">{{ $size->size_title ?? '' }}</div>
            <div class="fw-bold text-gray-400 mb-6">{{ $size->size_descriprion ?? '' }}</div>
            <div class="d-flex flex-center flex-wrap mb-5">
                @foreach ($size->charts as $item)
                    <!--begin::Stats-->
                    <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                        <div class="fs-6 fw-bolder text-gray-700">{{ $item->size_value ?? '' }}</div>
                        <div class="fw-bold text-gray-400">{{ $item->size_name ?? ''}}</div>
                    </div>
                    <!--end::Stats-->
                @endforeach

            </div>
        </div>
        <!--end::Card body-->
    </div>


    <div class="row g-6 mb-6 g-xl-9 mb-xl-9">
        <div class="col-md-6 col-xxl-4">
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-6 d-flex flex-center flex-column p-9">
                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-5">Men's</a>
                    <div class="d-flex flex-center flex-wrap mb-5">
                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->mens->US ?? ''}}</div>
                            <div class="fw-bold text-gray-400">US</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->mens->UK ?? ''}}</div>
                            <div class="fw-bold text-gray-400">UK</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->mens->EU ?? ''}}</div>
                            <div class="fw-bold text-gray-400">EU</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->mens->CM ?? ''}}</div>
                            <div class="fw-bold text-gray-400">CM</div>
                        </div>
                        <!--end::Stats-->

                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-md-6 col-xxl-4">
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-6 d-flex flex-center flex-column p-9">
                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-5">Women's</a>
                    <div class="d-flex flex-center flex-wrap mb-5">
                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->womens->US ?? ''}}</div>
                            <div class="fw-bold text-gray-400">US</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->womens->UK ?? ''}}</div>
                            <div class="fw-bold text-gray-400">UK</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->womens->EU ?? ''}}</div>
                            <div class="fw-bold text-gray-400">EU</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->womens->CM ?? ''}}</div>
                            <div class="fw-bold text-gray-400">CM</div>
                        </div>
                        <!--end::Stats-->

                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-md-6 col-xxl-4">
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body pt-6 d-flex flex-center flex-column p-9">
                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-5">Kid's</a>
                    <div class="d-flex flex-center flex-wrap mb-5">
                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->kids->US ?? ''}}</div>
                            <div class="fw-bold text-gray-400">US</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->kids->UK ?? ''}}</div>
                            <div class="fw-bold text-gray-400">UK</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->kids->EU ?? ''}}</div>
                            <div class="fw-bold text-gray-400">EU</div>
                        </div>
                        <!--end::Stats-->

                        <!--begin::Stats-->
                        <div class="border border-dashed rounded min-w-125px py-3 px-4 mx-3 mb-3 text-center">
                            <div class="fs-6 fw-bolder text-gray-700">{{ $size->kids->CM ?? ''}}</div>
                            <div class="fw-bold text-gray-400">CM</div>
                        </div>
                        <!--end::Stats-->

                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>

    <!--end::Card-->
</x-base-layout>
