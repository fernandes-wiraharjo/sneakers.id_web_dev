<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Generate Review Link</h1>
    </x-slot>

    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.external-review.store') }}" method="post" id="form">
                @csrf

                @include('externalreview::_partials._form', ['link' => $link, 'products' => $products])

                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">Generate Link</span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
