<x-base-layout>
    <x-slot name="title">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Edit Transaction Type</h1>
    </x-slot>
    <div class="card">
        <div class="card-body pt-6">
            <form action="{{ route('administrator.master-data.transaction-type.update', $transactionType->id) }}" method="post" id="transaction-type-form">
                @csrf
                @method('PUT')
                @include('reporting::transaction-type._partials._form', ['transactionType' => $transactionType, 'edit' => true])
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-base-layout>
