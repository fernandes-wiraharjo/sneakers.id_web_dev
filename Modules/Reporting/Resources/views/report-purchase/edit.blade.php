<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Report Purchase</h1>
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.report-purchase.update', $reportPurchase->id) }}" method="post" id="report-purchase-form">
                @csrf
                @method('PUT')
                @include('reporting::report-purchase._partials._form', ['reportPurchase' => $reportPurchase, 'edit' => true])
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
