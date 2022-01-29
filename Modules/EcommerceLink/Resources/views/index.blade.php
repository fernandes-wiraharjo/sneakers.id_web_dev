<x-base-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Ecommerce Link</h1>
    </x-slot>
    <x-slot name="button_create">
        @can('administrator.master-data.ecommerce-link.create')
        <!--begin::Wrapper-->
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover"
            title="Create a new ecommerce link">
            <a href="{{ route('administrator.master-data.ecommerce-link.create', ['back' => request()->fullUrl()]) }}"
                class="btn btn-sm btn-primary fw-bolder">
                Create Ecommerce Link
            </a>
        </div>
        <!--end::Wrapper-->
        @endcan
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            <x-ladmin-datatables :fields="$fields" :options="$options" />
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-base-layout>
