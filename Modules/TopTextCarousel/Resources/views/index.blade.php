<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Top Text Carousel</h1>
    </x-slot>
    <x-slot name="button_create">
        @can('administrator.master-data.top-text-carousel.create')
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create new top text carousel">
            <a href="{{ route('administrator.master-data.top-text-carousel.create', ['back' => request()->fullUrl()]) }}"
                class="btn btn-sm btn-primary fw-bolder">
                Create Top Text Carousel
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
