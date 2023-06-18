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
                <div role="region" aria-labelledby="step-section-primary-header">
                    <div class="Yil88 TpQRn ny1C6">
                        <div class="_1fragem15 _1fragemah _1fragemaf">
                            <h1 class="n8k95w1 _1fragemaf n8k95w2">Information</h1>
                        </div>
                        <div class="I3DjT TeFT5">
                            <div class="RTcqB">
                                <header role="banner" class="nBWgL">
                                    <div>
                                        <div class="_1fragem15 _1fragem8q _1fragem97 _1fragem89 _1fragem9o _1fragemaf">
                                            <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                                <style>
                                                    .iframe-invoice {
                                                        width: -webkit-fill-available;
                                                        height: 800px;
                                                    }
                                                    .Layout0>.i602M> :nth-child(1) {
                                                        flex: 0 0 100%;
                                                    }

                                                    .Layout0>.i602M {
                                                        flex-wrap: wrap;
                                                    }

                                                    .Layout0>.i602M {
                                                        max-width: 56rem;
                                                    }

                                                    @media all and (min-width: 1000px) {
                                                        .Layout0>.i602M {
                                                            max-width: 100%;
                                                        }
                                                    }

                                                </style>
                                                <div class="i602M AHe4G">
                                                    <div>
                                                        <div>
                                                            <div class="_1fragem15 _1fragemaf">
                                                                <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem24 _1fragem2l _1fragem36 _1fragem3a _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 20rem); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 20rem); --_16s97g7c: minmax(0, 1fr);">
                                                                    <p class="n8k95w1 _1fragemaf n8k95w2">
                                                                        <a href="#" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi3 _1fragemal">
                                                                            <img src="{{ asset('stores-info/logos-black-transparent.png') }}" alt="sneakers.id" class="hmHjN" style="max-width: min(100%, 200px);">
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <aside class="_PiNS CiOA7">
                                    <button type="button" aria-controls="disclosure_content" class="go8Cy" aria-pressed="true"
                                        aria-expanded="true">
                                        <span class="iibJ6">
                                            <div class="_1fragem17 _1fragemaf _1fragem38">
                                                <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                                    <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p a8x1wu4 _1fragem15 a8x1wui a8x1wuf a8x1wum">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false"
                                                            aria-hidden="true"
                                                            class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                            <circle cx="3.5" cy="11.9" r="0.3">
                                                            </circle>
                                                            <circle cx="10.5" cy="11.9" r="0.3">
                                                            </circle>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">
                                                        ORDER SUMMARY
                                                        <div class="_1fragem19 _16s97g727 _16s97g71j"></div>
                                                        <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p a8x1wu4 a8x1wue _1fragem19 a8x1wug a8x1wum">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"
                                                                focusable="false" aria-hidden="true"
                                                                class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                                                <p translate="yes" class="_1x52f9s1 _1fragemaf _1x52f9sp _1fragem1l _1x52f9s2 notranslate">
                                                    Rp {{ rupiah_format(intval($transaction->grand_total)) }}</p>
                                            </div>
                                        </span>
                                    </button>
                                    <div id="disclosure_content" class="_94sxtb1 _1fragem7q _1fragem7s _1fragemaf _1fragemav _1fragemaq _1fragemaz" style="height: auto; overflow: visible;">
                                        <div>
                                            <div class="awQ1u PK5O_">
                                                <div class="dnZK3">
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                                            <section class="_1fragem15 _1fragemaf">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                    <h2 id="ResourceList10" class="n8k95w1 _1fragemaf n8k95w3">Shopping cart</h2>
                                                                </div>
                                                                <div role="table" aria-labelledby="ResourceList10" class="_6zbcq55 _1fragem17 _1fragem1d _6zbcq58 _6zbcq56">
                                                                    <div role="row" class="_6zbcq51f _1fragem17 _1fragem4 _1fragem34 _6zbcq51d">
                                                                        <div role="columnheader" class="_6zbcq51g">
                                                                            <div class="_1fragem15 _1fragemah _1fragemaf">Product image
                                                                            </div>
                                                                        </div>
                                                                        <div role="columnheader" class="_6zbcq51g">
                                                                            <div class="_1fragem15 _1fragemah _1fragemaf">Description
                                                                            </div>
                                                                        </div>
                                                                        <div role="columnheader" class="_6zbcq51g">
                                                                            <div class="_1fragem15 _1fragemah _1fragemaf">Quantity</div>
                                                                        </div>
                                                                        <div role="columnheader" class="_6zbcq51g">
                                                                            <div class="_1fragem15 _1fragemah _1fragemaf">Price</div>
                                                                        </div>
                                                                    </div>
                                                                    @if($items)
                                                                        @foreach ($items as $id => $item)
                                                                        <div role="row" class="_6zbcq526 _1fragem17 _1fragem10 _6zbcq52d">
                                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                                                <div class="_1fragem15 _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragemaf _16s97g7r _16s97g7t _16s97g7v TOZIs" style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                                                    <div class="_1h3po421 _1h3po423 _1fragemaf" style="--_1h3po420: 1;">
                                                                                        <picture>
                                                                                            <source media="(min-width: 0px)" srcset="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 1x, {{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 2x, {{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 4x">
                                                                                            <img src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" alt="ZUMA" class="_1h3po424 _1fragem15 _1fragem9q _1fragem3k _1fragem3h _1fragem3n _1fragem3e _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragem5b _1fragem56 _1fragem5g _1fragem51 _1fragem9t">
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div aria-hidden="true" class="_1fragem17 _1fragem1d _1fragem49 _1fragem4e _1fragem4o _1fragem4j _1fragem4 _1fragem36 _1fragem8q _1fragem8u _1fragem89 _1fragem9b _1fragemad _16s97g7t _16s97g7v _16s97g7x _16s97g7h _16s97g7j _16s97g7l _16s97g7n AT21L" style="--_16s97g7s: 2.1rem; --_16s97g7u: 2.1rem; --_16s97g7w: translateX(calc(25% * var(--x-global-transform-direction-modifier))) translateY(-50%); --_16s97g7g: 0rem; --_16s97g7i: auto; --_16s97g7k: auto; --_16s97g7m: 0rem;">
                                                                                        <div class="_1fragem15 _1fragemaf s17WO">
                                                                                            <p class="_1x52f9s1 _1fragemaf _1x52f9sj _1fragem1i _1x52f9s2">
                                                                                                {{ $item->quantity }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _1fragem1g">
                                                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9s2">
                                                                                    {{ $item->detail->product->product_name }}
                                                                                </p>
                                                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                                                    Size : {{  $item->detail->size }}
                                                                                </div>
                                                                            </div>
                                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _6zbcq53w">
                                                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $item->quantity }}
                                                                                        <div aria-hidden="true" class="_1fragem15 _1fragemaf"> x
                                                                                        </div>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                                                <div class="_1fragem17 _1fragem1d _1fragem5 _1fragem36 _1fragemaf _16s97g7r _16s97g7t _16s97g7v bua0H" style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                                                                                        <span translate="yes"class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">
                                                                                            Rp {{ rupiah_format($item->price) }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <section class="_1fragem15 _1fragemaf">
                                                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                <h2 id="MoneyLine-Heading10" class="n8k95w1 _1fragemaf n8k95w3">Cost
                                                                    summary</h2>
                                                            </div>
                                                            <div role="table" aria-labelledby="MoneyLine-Heading10" class="nfgb6p0">
                                                                <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                                                    <div role="cell" class="_1qy6ue69">
                                                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j">Subtotal</span>
                                                                    </div>
                                                                    <div role="cell" class="_1qy6ue6a">
                                                                        <span translate="yes" class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp
                                                                            {{ rupiah_format($transaction->sub_total) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                                                    <div role="cell" class="_1qy6ue69">
                                                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1r _1fragem28 _1fragem0 _1fragem4 _1fragem38">
                                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Shipping {{ $shipping->shipping_method }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div role="cell" class="_1qy6ue6a">
                                                                        <span translate="yes" class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{  rupiah_format(intval($shipping->shipping_cost)) }}</span>
                                                                    </div>
                                                                </div>
                                                                <div role="row" class="_1x41w3p1 _1fragem1b _1fragem4 _1x41w3p8">
                                                                    <div role="cell" class="_1x41w3p9">
                                                                        <span class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1">Total</span>
                                                                    </div>
                                                                    <div role="cell" class="_1x41w3pa">
                                                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem3 _1fragem38">
                                                                                <abbr translate="yes" class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7 notranslate _19gi7ytq _1fragemal">IDR</abbr>
                                                                                <strong translate="yes" class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1 notranslate">Rp {{ rupiah_format(intval($transaction->grand_total)) }}</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <div class="dh43e">
                                    <div class="_1fragem15 _1fragemaf">

                                        {{-- The Master doesn't talk, he acts. --}}
                                        @if (!empty($successMessage))
                                        <div class="alert alert-success">
                                            {{ $successMessage }}
                                        </div>
                                        @endif

                                        <div class="row pt-3">
                                            {{-- Step 1 --}}
                                            <div id="step1" class="needs-validation">
                                                <div class="I_61l">
                                                    <div class="tAyc6">
                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1z _1fragem2g">
                                                                <main id="checkout-main">
                                                                    <form action="" method="POST" novalidate="" id="Form15"
                                                                        class="_1fragem16">
                                                                        <div class="_1fragemaf">
                                                                            <div>
                                                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                                                                </div>
                                                                                <div class="VheJw">
                                                                                    @php
                                                                                        // dump($items);
                                                                                        // dump($response);
                                                                                    @endphp
                                                                                    <h4>Order id
                                                                                        <span>
                                                                                            <h3>#{{ strtoupper($response['external_id']) }}</h3>
                                                                                        </span>
                                                                                    </h4>
                                                                                    <h3>Thankyou {{ $response['customer']['given_names'] }} {{ $response['customer']['surname'] }}</h3>

                                                                                    <section aria-label="Review" class="_1fragem15 _1fragemaf">
                                                                                        <div role="table" aria-label="Review your information" class="Z8Nx4 lT5DX">
                                                                                            <div role="row" class="NSCO_">
                                                                                                <div class="Qk5zF">
                                                                                                    <div role="cell" class="nkp8r">
                                                                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                                                                            <h2 id="step-section-primary-header" tabindex="-1" class="n8k95w1 _1fragemaf n8k95w3">Your Order is Confirmed</h2>
                                                                                                            <span>We'll process your order soon. <br> You'll receive email when your order is completed.</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>

                                                                                    <section aria-label="Review" class="_1fragem15 _1fragemaf">
                                                                                        <div role="table" aria-label="Review your information" class="Z8Nx4 lT5DX">
                                                                                            <div role="row" class="NSCO_">
                                                                                                <div class="Qk5zF" style="max-width: 60%;">
                                                                                                    <div role="cell" class="nkp8r">
                                                                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                                                                            <div role="cell" class="w3cHO">
                                                                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7"><h2 id="step-section-primary-header" tabindex="-1" class="n8k95w1 _1fragemaf n8k95w3">Order Details</h2></span>
                                                                                                            </div>
                                                                                                            <div role="cell" class="w3cHO">
                                                                                                                <h4>Contact</h4>
                                                                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7"></span>
                                                                                                                <span>{{ $destination->email }}</span>
                                                                                                            </div>

                                                                                                            <div role="cell" class="w3cHO">
                                                                                                                <h4>Shipping Address</h4>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->first_name }} {{ $destination->last_name }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->phone_number }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->address }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->region->area }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->region->subdistrict }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->region->district }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $destination->region->province }}, {{ $destination->region->post_code }}</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="Qk5zF">
                                                                                                    <div role="cell" class="nkp8r">
                                                                                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                                                                            <div role="cell" class="w3cHO">
                                                                                                                <h4>Payment Method</h4>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ str_replace('_', ' ', $response['payment_method']) }} - {{ $response['payment_channel'] }}</span>
                                                                                                                </div>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem3 _1fragem38">
                                                                                                                        <abbr translate="yes"
                                                                                                                            class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7 notranslate _19gi7ytq _1fragemal">IDR</abbr><strong
                                                                                                                            translate="yes"
                                                                                                                            class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1 notranslate">Rp {{ rupiah_format(intval($response['paid_amount'])) }}</strong>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div role="cell" class="w3cHO">
                                                                                                                <h4>Shipping Method</h4>
                                                                                                                <div role="cell" class="nkp8r">
                                                                                                                    <span>{{ $shipping->shipping_method }} - Rp {{ rupiah_format(intval($shipping->shipping_cost)) }}</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        Need help? <a href="#">Contact us</a>
                                                                                    </section>
                                                                                    <div class="oQEAZ WD4IV">
                                                                                        <div>
                                                                                            <a href="/" class="QT4by rqC98 hodFu VDIfJ j6D1f janiy" >
                                                                                                <span class="AjwsM">Continue shopping</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div>
                                                                                            <a href="{{ route('customer.dashboard') }}" class="QT4by eVFmT j6D1f janiy adBMs">
                                                                                                <span class="AjwsM">
                                                                                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                                                        <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                                                                                            <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wuh a8x1wuf a8x1wum"><svg
                                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                                    viewBox="0 0 14 14"
                                                                                                                    focusable="false"
                                                                                                                    aria-hidden="true"
                                                                                                                    class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                                                                    <path
                                                                                                                        stroke-linecap="round"
                                                                                                                        stroke-linejoin="round"
                                                                                                                        d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1">
                                                                                                                    </path>
                                                                                                                </svg>
                                                                                                            </span>
                                                                                                            <span class="_19gi7yt0 _19gi7yte _1fragem1j">Return to Transaction Status</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </span>
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                            <button type="submit" tabindex="-1" aria-hidden="true">Return to Transaction Status</button>
                                                                        </div>
                                                                    </form>
                                                                </main>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <footer role="contentinfo" class="QDqGb">
                                                <div class="HgABA">
                                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                                        <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem2 _1fragem6 _1fragem1r _1fragem25 _1fragem38">
                                                            <button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x">
                                                                <span class="AjwsM">
                                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                                        Refund policy
                                                                    </span>
                                                                </span>
                                                            </button>
                                                            <button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x">
                                                                <span class="AjwsM">
                                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                                        Privacy policy
                                                                    </span>
                                                                </span>
                                                            </button>
                                                            <button type="button" aria-haspopup="dialog" class="QT4by eVFmT janiy mRJ8x">
                                                                <span class="AjwsM">
                                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                                        Terms of service
                                                                    </span>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <aside class="I3DjT aADa7 fiOsL WrWRL">
                            <div class="_1fragemah">
                                <h2 class="n8k95w1 _1fragemaf n8k95w3">Order summary</h2>
                            </div>
                            <div class="RTcqB">
                                <div class="I_61l">
                                    <div class="tAyc6">
                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                                                <section class="_1fragem15 _1fragemaf">
                                                    <div class="_1fragem15 _1fragemah _1fragemaf">
                                                        <h3 id="ResourceList0" class="n8k95w1 _1fragemaf n8k95w4"> Shopping cart</h3>
                                                    </div>
                                                    <div role="table" aria-labelledby="ResourceList0"
                                                        class="_6zbcq55 _1fragem17 _1fragem1d _6zbcq58 _6zbcq56">
                                                        <div role="row" class="_6zbcq51f _1fragem17 _1fragem4 _1fragem34 _6zbcq51d">
                                                            <div role="columnheader" class="_6zbcq51g">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">Product
                                                                    image</div>
                                                            </div>
                                                            <div role="columnheader" class="_6zbcq51g">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                    Description</div>
                                                            </div>
                                                            <div role="columnheader" class="_6zbcq51g">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">Quantity
                                                                </div>
                                                            </div>
                                                            <div role="columnheader" class="_6zbcq51g">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">Price
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if($items)
                                                        <div role="row" class="_6zbcq51f _1fragem17 _1fragem4 _1fragem34 _6zbcq51d" style="padding-bottom: 20px;">
                                                            <h2 class="n8k95w1 _1fragemaf n8k95w3">Order summary</h2>
                                                        </div>

                                                        @foreach ($items as $id => $item)
                                                        <div role="row" class="_6zbcq526 _1fragem17 _1fragem10 _6zbcq52d">
                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                                <div class="_1fragem15 _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragemaf _16s97g7r _16s97g7t _16s97g7v TOZIs"
                                                                    style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                                    <div class="_1h3po421 _1h3po423 _1fragemaf" style="--_1h3po420: 1;">
                                                                        <picture>
                                                                            <source media="(min-width: 0px)"
                                                                                srcset="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 1x, {{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 2x, {{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }} 4x">
                                                                            <img src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" alt="ZUMA"
                                                                                class="_1h3po424 _1fragem15 _1fragem9q _1fragem3k _1fragem3h _1fragem3n _1fragem3e _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragem5b _1fragem56 _1fragem5g _1fragem51 _1fragem9t">
                                                                        </picture>
                                                                    </div>
                                                                    <div aria-hidden="true"
                                                                        class="_1fragem17 _1fragem1d _1fragem49 _1fragem4e _1fragem4o _1fragem4j _1fragem4 _1fragem36 _1fragem8q _1fragem8u _1fragem89 _1fragem9b _1fragemad _16s97g7t _16s97g7v _16s97g7x _16s97g7h _16s97g7j _16s97g7l _16s97g7n AT21L"
                                                                        style="--_16s97g7s: 2.1rem; --_16s97g7u: 2.1rem; --_16s97g7w: translateX(calc(25% * var(--x-global-transform-direction-modifier))) translateY(-50%); --_16s97g7g: 0rem; --_16s97g7i: auto; --_16s97g7k: auto; --_16s97g7m: 0rem;">
                                                                        <div class="_1fragem15 _1fragemaf s17WO">
                                                                            <p
                                                                                class="_1x52f9s1 _1fragemaf _1x52f9sj _1fragem1i _1x52f9s2">
                                                                                {{ $item->quantity }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div role="cell"
                                                                class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _1fragem1g">
                                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9s2">
                                                                    {{ $item->detail->product->product_name }}</p>
                                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                                    Size : {{ $item->detail->size }}
                                                                </div>
                                                            </div>
                                                            <div role="cell"
                                                                class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _6zbcq53w">
                                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $item->quantity }}
                                                                        <div aria-hidden="true" class="_1fragem15 _1fragemaf"> x
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                                <div class="_1fragem17 _1fragem1d _1fragem5 _1fragem36 _1fragemaf _16s97g7r _16s97g7t _16s97g7v bua0H"
                                                                    style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                                    <div
                                                                        class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                                                                        <span translate="yes"
                                                            class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format($item->price) }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </section>
                                            </div>
                                            <hr>
                                            <section class="_1fragem15 _1fragemaf">
                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                    <h3 id="MoneyLine-Heading0" class="n8k95w1 _1fragemaf n8k95w4">
                                                        Cost summary</h3>
                                                </div>
                                                <div role="table" aria-labelledby="MoneyLine-Heading0" class="nfgb6p0">
                                                    <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                                        <div role="cell" class="_1qy6ue69"><span
                                                                class="_19gi7yt0 _19gi7yte _1fragem1j">Subtotal</span>
                                                        </div>
                                                        <div role="cell" class="_1qy6ue6a"><span translate="yes"
                                                                class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp {{ rupiah_format(intval($transaction->sub_total)) }}</span>
                                                        </div>
                                                    </div>
                                                    <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                                        <div role="cell" class="_1qy6ue69">
                                                            <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                <div
                                                                    class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1r _1fragem28 _1fragem0 _1fragem4 _1fragem38">
                                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">Shipping {{ $shipping->shipping_method }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div role="cell" class="_1qy6ue6a"><span translate="yes"
                                                                class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{  rupiah_format(intval($shipping->shipping_cost)) }}</span>
                                                        </div>
                                                    </div>
                                                    <div role="row" class="_1x41w3p1 _1fragem1b _1fragem4 _1x41w3p8">
                                                        <div role="cell" class="_1x41w3p9"><span
                                                                class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1">Total</span>
                                                        </div>
                                                        <div role="cell" class="_1x41w3pa">
                                                            <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                <div
                                                                    class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem3 _1fragem38">
                                                                    <abbr translate="yes"
                                                                        class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7 notranslate _19gi7ytq _1fragemal">IDR</abbr><strong
                                                                        translate="yes"
                                                                        class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1 notranslate">Rp {{ rupiah_format(intval($transaction->grand_total)) }}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

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
