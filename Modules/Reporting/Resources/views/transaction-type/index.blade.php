<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Report: Transaction Type</h1>
    </x-slot>
    <x-slot name="button_create">
        @can('administrator.master-data.transaction-type.create')
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create new transaction type">
            <a href="{{ route('administrator.master-data.transaction-type.create', ['back' => request()->fullUrl()]) }}"
                class="btn btn-sm btn-primary fw-bolder">
                Create Transaction Type
            </a>
        </div>
        @endcan
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            {{ $dataTable->table() }}
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
</x-base-layout>
