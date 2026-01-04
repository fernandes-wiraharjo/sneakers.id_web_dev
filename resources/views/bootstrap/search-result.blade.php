@extends('bootstrap.layout')

@section('title', 'SEARCH PRODUCT')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 header-image-wrapper">
            <img src="{{ $headerImageURL }}" alt="Search Results" class="w-100">
        </div>
    </div>
</div>
<div class="container border-1 shadow rounded-4 py-4 px-3 bg-white position-relative z-1 product-list-container">
    @livewire('global-search', ['keyword' => $keyword])
</div>
@endsection

