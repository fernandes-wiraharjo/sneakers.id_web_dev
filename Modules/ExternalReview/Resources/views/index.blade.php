<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">External Review Links</h1>
    </x-slot>
    <x-slot name="button_create">
        @can('administrator.external-review.create')
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Generate a one-time review link">
            <a href="{{ route('administrator.external-review.create', ['back' => request()->fullUrl()]) }}"
                class="btn btn-sm btn-primary fw-bolder">
                Generate Link
            </a>
        </div>
        @endcan
    </x-slot>

    @if (session('generated_link'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Link generated:</strong>
            <div class="d-flex align-items-center gap-2 mt-2">
                <input type="text" class="form-control form-control-sm" id="generated-link" value="{{ session('generated_link') }}" readonly>
                <button type="button" class="btn btn-sm btn-primary" onclick="copyGeneratedLink()">Copy</button>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body pt-6">
            {{ $dataTable->table() }}
        </div>
    </div>

    @push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        function copyLink(id) {
            var input = document.getElementById('link-' + id);
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);
        }

        function copyGeneratedLink() {
            var input = document.getElementById('generated-link');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);
        }
    </script>
    @endpush
</x-base-layout>
