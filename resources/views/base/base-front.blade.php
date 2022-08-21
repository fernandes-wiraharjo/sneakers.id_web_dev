<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    {!! theme()->printHtmlAttributes('html') !!} {{ theme()->printHtmlClasses('html') }}>
{{-- begin::Head --}}
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0" />
    <meta name="theme-color" content="" />

    <!-- Primary Meta Tags -->
    <title>SNEAKERS.ID — WE AIN'T TALKIN' BOUT FAKE</title>
    <meta name="title" content="SNEAKERS.ID — WE AIN'T TALKIN' BOUT FAKE">
    <meta name="keyword" content="nike sneakers, new balance sneakers, shoes, sport shoes, sepatu sneakers, sneaker, sepatu sneakers wanita, sepatu sneakers pria, adidas, sepatu adidas, sepatu air jordan, sepatu nike, nike, air jordan, original, sepatu original, sneakers original, sneakers asli, sepatu sneakers original, sepatu original sneakers, sneakers.id, jakarta sneakers day, sepatu sneakers jakarta" >
    <meta name="description" content="US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://sneakers.id/">
    <meta property="og:title" content="SNEAKERS.ID — WE AIN'T TALKIN' BOUT FAKE">
    <meta property="og:description" content="US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.">
    <meta property="og:image" content="https://sneakers.id/stores-info/logos.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://sneakers.id/">
    <meta property="twitter:title" content="SNEAKERS.ID — WE AIN'T TALKIN' BOUT FAKE">
    <meta property="twitter:description" content="US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.">
    <meta property="twitter:image" content="https://sneakers.id/stores-info/logos.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css"/>
    {{-- begin::Fonts --}}
    {{ theme()->includeFonts() }}
    {{-- end::Fonts --}}

    @if (theme()->hasOption('page', 'assets/vendors/css'))
        {{-- begin::Page Vendor Stylesheets(used by this page) --}}
        @foreach (theme()->getOption('page', 'assets/vendors/css') as $file)
            <link href="{{ assetCustom($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Page Vendor Stylesheets --}}
    @endif

    @if (theme()->hasOption('page', 'assets/custom/css'))
        {{-- begin::Page Custom Stylesheets(used by this page) --}}
        @foreach (theme()->getOption('page', 'assets/custom/css') as $file)
            <link href="{{ assetCustom($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Page Custom Stylesheets --}}
    @endif

    @if (theme()->hasOption('assets', 'css'))
        {{-- begin::Global Stylesheets Bundle(used by all pages) --}}
        @foreach (theme()->getOption('assets', 'css') as $file)
            <link href="{{ assetCustom($file) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        {{-- end::Global Stylesheets Bundle --}}
    @endif

    @if (theme()->getViewMode() === 'preview')
        {{ theme()->getView('partials/trackers/_ga-general') }}
        {{ theme()->getView('partials/trackers/_ga-tag-manager-for-head') }}
    @endif

    {!! $styles ?? null !!}
    @livewireStyles

    @stack('styles')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <style>
        .aside-enabled.aside-fixed.header-fixed .header {
            left: 0 !important;
        }

        html * {
            font-family: 'Montserrat', sans-serif, 'FontAwesome' !important;
        }

        .accordion-button:not(.collapsed) {
            color: unset;
            background-color: unset;
            box-shadow: unset;
        }

        .accordion-button.collapsed {
            background-color: unset;
        }

        .accordion-body {
            padding: 0 1.5rem;
        }

        body {
            background-color: #f5f5f5 !important;
        }

        .card.card-body.product-list {
            padding: 0 !important;
            margin: 0;
        }

        .select2-container--bootstrap5 .select2-dropdown {
            box-shadow: unset;
            border-radius: unset;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--highlighted {
            color: unset;
            background-color: unset;
            text-align: end;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected {
            font-weight: 600;
        }

        .page-item .page-link {
            background-color: transparent !important;
        }
    </style>

</head>
{{-- end::Head --}}

{{-- begin::Body --}}
<body {!! theme()->printHtmlAttributes('body') !!} {!! theme()->printHtmlClasses('body') !!} {!! theme()->printCssVariables('body') !!}>

@if (theme()->getOption('layout', 'loader/display') === true)
    {{ theme()->getView('layout/_loader') }}
@endif

@yield('content')

{{-- begin::Javascript --}}
@if (theme()->hasOption('assets', 'js'))
    {{-- begin::Global Javascript Bundle(used by all pages) --}}
    @foreach (theme()->getOption('assets', 'js') as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Global Javascript Bundle --}}
@endif

@if (theme()->hasOption('page', 'assets/vendors/js'))
    {{-- begin::Page Vendors Javascript(used by this page) --}}
    @foreach (theme()->getOption('page', 'assets/vendors/js') as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Vendors Javascript --}}
@endif

@if (theme()->hasOption('page', 'assets/custom/js'))
    {{-- begin::Page Custom Javascript(used by this page) --}}
    @foreach (theme()->getOption('page', 'assets/custom/js') as $file)
        <script src="{{ asset(theme()->getDemo() . '/' .$file) }}"></script>
    @endforeach
    {{-- end::Page Custom Javascript --}}
@endif
{{-- end::Javascript --}}
@stack('top-scripts')
@if (theme()->getViewMode() === 'preview')
    {{ theme()->getView('partials/trackers/_ga-tag-manager-for-body') }}
@endif

<script src="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{!! $scripts ?? null !!}
@stack('modals')

@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
@include('sweetalert::alert')
</body>
{{-- end::Body --}}
</html>
