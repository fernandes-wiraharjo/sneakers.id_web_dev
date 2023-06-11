<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout/1.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout/2.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout/3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout/4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/checkout/5.css') }}" />
    <title>Checkout</title>
    @livewireStyles
    <style>
        .breadcrumb {
            align-items: center;
            justify-content: center;
        }

        .breadcrumb-item a {
            text-decoration: auto;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: var(--bs-breadcrumb-divider, ">");
        }

        .list-items {
            background-color: gray;
        }

        @media screen and (max-width: 1000px) {
            .dh43e {
                padding: 0px 50px;
            }
        }
    </style>
</head>

<body>
    <div class="_1coqx421">
        <div class="g9gqqf1 _1fragembe _1fragem1j">
            <div class="_1fragem15 _1fragemaf">
                @livewire('checkout-process')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/checkout/1.js') }}" ></script>
    <script src="{{ asset('js/checkout/2.js') }}" ></script>
    <script src="{{ asset('js/checkout/3.js') }}" ></script>
    <script src="{{ asset('js/checkout/4.js') }}" ></script>
    <script src="{{ asset('js/checkout/5.js') }}" ></script>
    <script src="{{ asset('js/checkout/6.js') }}" ></script>
    <script src="{{ asset('js/checkout/7.js') }}" ></script>
    {{-- <script src="{{ asset('js/checkout/8.js') }}" ></script> --}}
    <script src="{{ asset('js/checkout/9.js') }}" ></script>
    <script src="{{ asset('js/checkout/10.js') }}" ></script>
    <script src="{{ asset('js/checkout/11.js') }}" ></script>
    <script src="{{ asset('js/checkout/12.js') }}" ></script>
    <script src="{{ asset('js/checkout/13.js') }}" ></script>
    <script src="{{ asset('js/checkout/14.js') }}" ></script>
    <script src="{{ asset('js/checkout/15.js') }}" ></script>
    <script src="{{ asset('js/checkout/16.js') }}" ></script>
    <script src="{{ asset('js/checkout/17.js') }}" ></script>
    {{-- <script src="{{ asset('js/checkout/18.js') }}" ></script> --}}
    {{-- <script src="{{ asset('js/checkout/19.js') }}" ></script> --}}
    <script src="{{ asset('js/checkout/trekkie.storefront.min.js') }}" ></script>
    @livewireScripts
</body>

</html>
