<x-base-layout>
    <x-slot name="styles">
        {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Brand</h1>
    </x-slot>
    <x-slot name="button_create">
        @can('administrator.master-data.brand.create')
        <!--begin::Wrapper-->
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create a new brand">
            <a href="{{ route('administrator.master-data.brand.create', ['back' => request()->fullUrl()]) }}"
                class="btn btn-sm btn-primary fw-bolder">
                Create Brand
            </a>
        </div>
        <!--end::Wrapper-->
        @endcan
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            {{--
            <x-ladmin-datatables :fields="$fields" :options="$options" /> --}}
            {{ $dataTable->table() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    {{-- Inject Scripts --}}
    @push('scripts')
    {{ $dataTable->scripts() }}
    @endpush
</x-base-layout>
