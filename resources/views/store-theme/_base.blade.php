<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0" />
        <meta name="theme-color" content="" />

        <!-- Primary Meta Tags -->
        <title>SNEAKERS.ID - @yield('title')</title>
        <!-- Primary Meta Tags -->
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

        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" />

        @include('store-theme._partials._scripts')

        @include('store-theme._partials._styles')

        @stack('styles')

        @livewireStyles
    </head>
    <body class="prestige--v4 template-collection">
        @include('store-theme._partials._navbar')

        <main id="main" role="main">
            @yield('body')
        </main>

        @include('store-theme._partials._footer')

        @include('store-theme._partials._bottom_scripts')

        @stack('scripts')
        @livewireScripts
    </body>
</html>
