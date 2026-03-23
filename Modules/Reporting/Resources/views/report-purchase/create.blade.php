<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Create Report Purchase</h1>
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.report-purchase.store') }}" method="post" id="report-purchase-form">
                @csrf
                @include('reporting::report-purchase._partials._form', ['reportPurchase' => $reportPurchase, 'transactionTypes' => $transactionTypes ?? collect(), 'edit' => false])
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" id="form-submit">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
