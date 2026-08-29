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
