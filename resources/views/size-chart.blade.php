@extends('store-theme._base')

@section('title', 'SIZE CHART')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/size-chart.css') }}" />
@endpush

@section('body')
    <!-- Tab links -->
    <div class="tab">
        <button class="tablinks active" onclick="openCity(event, 'Men`s')">Men's</button>
        <button class="tablinks" onclick="openCity(event, 'Women`s')">Women's</button>
        <button class="tablinks" onclick="openCity(event, 'Kid`s')">Kid's</button>
    </div>

    <!-- Tab content -->
    <div id="Men`s" class="tabcontent" style="display: block">
        <h1 class="Heading u-h2 text-center">Men's Sizes</h1>
        <div class="table-header">
            <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
            <div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
            <div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
            <div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
        </div>
        <div class="table-content">
            @foreach ($men_sizes as $item)
                <div class="table-row">
                    <div class="table-data">{{ $item->US }}</div>
                    <div class="table-data">{{ $item->UK }}</div>
                    <div class="table-data">{{ $item->EU }}</div>
                    <div class="table-data">{{ $item->CM }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="Women`s" class="tabcontent">
        <h1 class="Heading u-h2 text-center">Women's Sizes</h1>
        <div class="table-header">
            <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
            <div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
            <div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
            <div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
        </div>
        <div class="table-content">
            @foreach ($women_sizes as $item)
                <div class="table-row">
                    <div class="table-data">{{ $item->US }}</div>
                    <div class="table-data">{{ $item->UK }}</div>
                    <div class="table-data">{{ $item->EU }}</div>
                    <div class="table-data">{{ $item->CM }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="Kid`s" class="tabcontent">
        <h1 class="Heading u-h2 text-center">Kid's Sizes</h1>
        <div class="table-header">
            <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">US</a></div>
            <div class="header__item"><a id="uk" class="filter__link filter__link--number" href="#">UK</a></div>
            <div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">EU</a></div>
            <div class="header__item"><a id="eu" class="filter__link filter__link--number" href="#">CM</a></div>
        </div>
        <div class="table-content">
            @foreach ($kid_sizes as $item)
                <div class="table-row">
                    <div class="table-data">{{ $item->US }}</div>
                    <div class="table-data">{{ $item->UK }}</div>
                    <div class="table-data">{{ $item->EU }}</div>
                    <div class="table-data">{{ $item->CM }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/size-chart.js') }}" defer></script>
@endpush


