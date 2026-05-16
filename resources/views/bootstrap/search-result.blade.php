@extends('bootstrap.layout')

@section('title', 'SEARCH PRODUCT')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 header-image-wrapper position-relative">
            <img src="{{ $headerImageURL }}" alt="Search Results" class="w-100">
            <div style="font-size: 12rem; line-height: 1" class="position-absolute bottom-0 start-0 end-0 text-center text-uppercase fw-bold text-white">
                {{ substr(str_replace('+', ' ', $keyword), 0, 10) }}
                @if (strlen($keyword) > 10)
                    <span class="text-white">...</span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container border-1 shadow rounded-4 py-4 px-3 bg-white position-relative z-1 product-list-container">
    @livewire('global-search', ['keyword' => $keyword])
</div>
@endsection

