<x-base-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/pages/timeline-resi.css') }}">
    </x-slot>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Transactions</h1>
    </x-slot>
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-6">
            {{-- <x-ladmin-datatables :fields="$fields" :options="$options" /> --}}
            {{ $dataTable->table() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @push('scripts')
        {{ $dataTable->scripts() }}

        <script src="{{ asset('js/check-resi.js') }}" defer></script>
    @endpush
</x-base-layout>
