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
        <meta name="title" content="SNEAKERS.ID — @if(trim($__env->yieldContent('title'))) @yield('title') @else 'WE AIN'T TALKIN' BOUT FAKE' }} @endif">
        <meta name="keyword" content="nike sneakers, new balance sneakers, shoes, sport shoes, sepatu sneakers, sneaker, sepatu sneakers wanita, sepatu sneakers pria, adidas, sepatu adidas, sepatu air jordan, sepatu nike, nike, air jordan, original, sepatu original, sneakers original, sneakers asli, sepatu sneakers original, sepatu original sneakers, sneakers.id, jakarta sneakers day, sepatu sneakers jakarta" >
        <meta name="description" content="@if(trim($__env->yieldContent('description'))) @yield('description') @else 'US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.' @endif">
        <meta name="facebook-domain-verification" content="fviop5qj9pavjiawjtsaz9skn04ei5" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://sneakers.id/">
        <meta property="og:title" content="SNEAKERS.ID — @if(trim($__env->yieldContent('title'))) @yield('title') @else 'WE AIN'T TALKIN' BOUT FAKE' }} @endif">
        <meta property="og:description" content="@if(trim($__env->yieldContent('description'))) @yield('description') @else 'US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.' @endif">
        <meta property="og:image" content="https://sneakers.id/stores-info/logos.png">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://sneakers.id/">
        <meta property="twitter:title" content="SNEAKERS.ID — @if(trim($__env->yieldContent('title'))) @yield('title') @else 'WE AIN'T TALKIN' BOUT FAKE' }} @endif">
        <meta property="twitter:description" content="@if(trim($__env->yieldContent('description'))) @yield('description') @else 'US PREORDER, READY STOCK, DAN CONSIGNMENT. HANYA MENJUAL BARANG ORIGINAL DAN AUTHENTIC. TIDAK MENJUAL BARANG PALSU.' @endif">
        <meta property="twitter:image" content="https://sneakers.id/stores-info/logos.png">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}" />

        @include('display-store.store-theme._partials._scripts')

        @include('display-store.store-theme._partials._styles')

        @stack('styles')

        @livewireStyles

        <style>
            .fa-2x {
                font-size: 4.5em !important;
            }

            .my-float{
                margin-top:17px;
            }
            }
            .float {
                position: fixed;
                width: 100px;
                height: 100px;
                bottom: 40px;
                right: 40px;
                background-color: #0C9;
                color: #FFF;
                border-radius: 50px;
                text-align: center;
                box-shadow: 2px 2px 3px #999;
            }

            .fa-2x {
                font-size: 4.5em !important;
            }

            .my-float{
                margin-top:17px;
            }

            .Linklist__Item>.Link, .Linklist__Item>.shopify-payment-button__more-options {
                display: block;
                width: 100%;
                text-align: inherit;
                font-size: 12px;
            }

            .bc-sf-search-suggestion-header {
                box-shadow: 0 1px #0000000d;
                text-transform: uppercase;
                background: #f5f5f5;
                text-align: left;
                padding: 5px 10px 4px;
                color: #a0a0a0;
                margin: 0;
                font-size: 16px;
            }

            @media only screen and (min-width: 1007px) {
                #main {
                    padding: 0 8%;
                }

                .Footer .Container {
                    padding: 0 8%;
                }

                .Header__Wrapper {
                    background-color: black;
                    padding: 18px 8%;
                }
            }

            @media screen and (min-width: 1240px) {
                .Header:not(.Header--sidebar) .Header__Wrapper {
                    padding: 18px 8%;
                }
            }


            @media only screen and (max-width: 1007px) {
                .float {
                    position: fixed;
                    width: 60px;
                    height: 60px;
                    bottom: 40px;
                    right: 40px;
                    background-color: #0C9;
                    color: #FFF;
                    border-radius: 50px;
                    text-align: center;
                    box-shadow: 2px 2px 3px #999;
                }

                .fa-2x {
                    font-size: 2.5em !important;
                }

                .my-float{
                    margin-top:13px;
                }
            }

            .Footer {
                background-color: black;
                color: white !important;
            }

            .Footer__Aside, .Footer__Title, .Footer__Block, .Footer__Block--text{
                color: white !important;
            }

            .Footer .Heading {
                color: white;
            }
        </style>
    </head>
    <body class="prestige--v4 template-collection">
        @include('display-store.store-theme._partials._navbar')

        <main id="main" role="main">
            @yield('body')

            <a href="https://api.whatsapp.com/send?phone={{ '6289617925925' }}" target="_blank" class="float">
                <i class="fa fa-whatsapp my-float fa-2x"></i>
            </a>
        </main>

        @include('display-store.store-theme._partials._footer')

        @include('display-store.store-theme._partials._bottom_scripts')

        @stack('scripts')

        @livewireScripts
    </body>
</html>
