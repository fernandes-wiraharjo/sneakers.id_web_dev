@extends('bootstrap.layout')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-5">
            <a href="javascript:history.back()" class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0">
                Frequently Asked Question (FAQ)
            </h1>
        </div>
        <div class="col-12">
            @include('bootstrap.parts.faq-content', ['faq' => $faq])
        </div>
    </div>
</div>
@endsection