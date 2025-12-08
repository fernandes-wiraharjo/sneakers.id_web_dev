@extends('bootstrap.layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <img src="https://placehold.co/1280x400?text=Header+Image+Placeholder" alt="Collections" class="w-100">
        </div>
    </div>
</div>
<div class="container border-1 shadow rounded-5 p-3">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0 text-uppercase">
                @if (request()->filter == 'all')
                    ALL PRODUCT
                @else
                    {{ str_replace('all.', '', request()->filter) }}
                @endif
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @livewire('product-list', ['keyword' => $keyword])
        </div>
    </div>
</div>
@endsection

