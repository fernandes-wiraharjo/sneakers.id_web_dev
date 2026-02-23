<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Report Purchase</h1>
    </x-slot>
    <x-slot name="button_create">
        <div class="d-flex flex-wrap gap-2">
            @can('administrator.report-purchase.create')
            <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create new report purchase">
                <a href="{{ route('administrator.report-purchase.create', ['back' => request()->fullUrl()]) }}"
                    class="btn btn-sm btn-primary fw-bolder">
                    Create Report Purchase
                </a>
            </div>
            @endcan
            @can('administrator.report-purchase.index')
            <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Sync from transactions that have AWB">
                <form action="{{ route('administrator.report-purchase.sync-from-transactions') }}" method="post" class="d-inline" onsubmit="return confirm('Sync transactions with AWB into this report? Transactions already in the report will be skipped.');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info fw-bolder">
                        Sync from Transactions
                    </button>
                </form>
            </div>
            @endcan
        </div>
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
