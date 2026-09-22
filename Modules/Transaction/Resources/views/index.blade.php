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
            @php
                $statusTab = $statusTab ?? request('status', 'all');
                $tabCounts = $tabCounts ?? [];
                $tabs = [
                    'all' => ['label' => 'All', 'class' => 'text-gray-800', 'active' => 'active text-gray-900 border-gray-800', 'badge' => 'badge-light'],
                    'pending' => ['label' => 'Pending Payment', 'class' => 'text-warning', 'active' => 'active text-warning border-warning', 'badge' => 'badge-warning'],
                    'success' => ['label' => 'Success', 'class' => 'text-success', 'active' => 'active text-success border-success', 'badge' => 'badge-success'],
                    'completed' => ['label' => 'Completed', 'class' => 'text-primary', 'active' => 'active text-primary border-primary', 'badge' => 'badge-primary'],
                    'failed' => ['label' => 'Failed', 'class' => 'text-danger', 'active' => 'active text-danger border-danger', 'badge' => 'badge-danger'],
                ];
            @endphp
            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                @foreach ($tabs as $key => $tab)
                    <li class="nav-item">
                        <a href="{{ route('administrator.transaction.index', $key === 'all' ? [] : ['status' => $key]) }}"
                           class="nav-link {{ $statusTab === $key ? $tab['active'] : $tab['class'] }}">
                            {{ $tab['label'] }}
                            @if(isset($tabCounts[$key]))
                                <span class="badge {{ $tab['badge'] }} ms-1">{{ $tabCounts[$key] }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex flex-wrap align-items-center gap-3 mb-5">
                <div class="position-relative flex-grow-1" style="max-width: 480px;">
                    <span class="svg-icon svg-icon-2 position-absolute top-50 translate-middle-y ms-4">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input
                        type="search"
                        id="transaction-search"
                        class="form-control form-control-solid ps-12"
                        placeholder="Search transaction ID, name, product, SKU, phone, email..."
                        value="{{ request('search_query') }}"
                        autocomplete="off"
                    >
                </div>
                <button type="button" id="transaction-search-btn" class="btn btn-primary">
                    Search
                </button>
                <button type="button" id="transaction-search-clear" class="btn btn-light">
                    Clear
                </button>
            </div>

            {{ $dataTable->table() }}
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @push('scripts')
        {{ $dataTable->scripts() }}

        <script src="{{ asset('js/check-resi.js') }}" defer></script>
        <script>
            $(document).ready(function () {
                var $input = $('#transaction-search');
                var table = $('#transaction-table').DataTable();

                function reloadTransactions() {
                    table.ajax.reload(null, true);
                }

                $('#transaction-search-btn').on('click', function () {
                    reloadTransactions();
                });

                $('#transaction-search-clear').on('click', function () {
                    $input.val('');
                    reloadTransactions();
                });

                $input.on('keydown', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        reloadTransactions();
                    }
                });
            });
        </script>
    @endpush
</x-base-layout>
