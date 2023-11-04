@extends('store-theme._base')

@section('title', $product->product_name)
@section('description', strip_tags($product->description))

@push('styles')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/product-detail.css') }}" />
<style>
    .Button--selected{
        color: black;
    }
    .Button--selected::before {
        background-color: white !important;
    }

    .size-select,
    .size-select::before,
    .size-select::after {
        box-sizing: border-box;
    }

    .size-select {
        min-width: 15ch;
        max-width: 30ch;
        border: 1px solid var(--select-border);
        padding: 0.25em 0.5em;
        font-size: 15px;
        font-weight: 400;
        font-style: normal;
        cursor: pointer;
        line-height: 1.1;
        color: rgb(0, 0, 0);
        background-color: rgb(255, 254, 254);
    }

    select:focus + .focus {
        position: absolute;
        top: -1px;
        left: -1px;
        right: -1px;
        bottom: -1px;
        border: 2px solid var(--select-focus);
        border-radius: inherit;
        }

        donate-now {
            list-style-type: none;
            margin: 25px 0 0 0;
            padding: 0;
        }

        .donate-now li {
            float: left;
            margin: 5px;
            width: 100px;
            height: 40px;
            position: relative;
            cursor: pointer;
            list-style: none;
        }

        .donate-now label,
        .donate-now input {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .donate-now input[type="radio"] {
            opacity: 0.01;
            z-index: 100;
            height: 40px;
            width: 100px;
            cursor: pointer;
        }

        .donate-now input[type="radio"]:checked+label,
        .checked+label {
            background: #ffffff;
            border: 1px solid #999999;
        }

        .donate-now input[type="radio"]:hover+label,
        .hover+label {
            background: #ffffff;
            border: 1px solid #999999;
            background: #e0dddd;
        }

        .donate-now label {
            padding: 5px;
            /* border: 1px solid #000000; */
            border: 1px solid #000000;
            cursor: pointer;
            z-index: 90;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            background-color: #f1f1f1ff;
        }

        .donate-now label:hover {
            background: #ffffff;
            border: 1px solid #999999;
        }
        .gallery {
            /* display: inline-block;
            position: relative; */
            display: flex;
            flex-direction: row;
            row-gap: 16px;
            column-gap: 16px;
            align-content: center;
            position: sticky;
            top: 40px;
            padding-left: 48px;
            margin-left: 8px;
            max-height: 35vh;
        }

        .main {
            max-height: 70vh;
        }

        .main img{
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            border-bottom-left-radius: 8px;
            overflow-x: hidden;
            overflow-y: hidden;
            position: relative;
            -webkit-box-flex: 1;
            flex-grow: 1;
            object-fit: contain;
            max-height: 78vh;
        }

        .thumbnails {

            display: flex;
            position: relative;
            flex-direction: column;
            -webkit-box-flex: 1;
            flex-grow: 1;
            column-gap: 8px;
            min-width: 80px;
            max-width: 80px;
            height: 100%;
            max-height: 80vh;
            overflow-y: scroll;
        }

        .thumbnails .item img {
            position: relative;
            width: 80px;
            height: 80px;
            max-width: 80px;
            max-height: 80px;
            cursor: pointer;
            padding: 0 0 5px 0;
            border-radius: 8px 8px 8px 8px;
            object-fit: cover;
        }

        @media (min-width: 960px) {
            .gallery {
                /* width: 100%; */
                /* height: 600px; */
            }
        }

        @media {

        }
</style>
@endpush

@section('body')
    <!-- /spurit_sri-added -->
    <div id="shopify-section-product-template" class="shopify-section shopify-section--bordered"
    style="margin: 5%;">
    <section class="Product Product--large" data-section-id="product-template" data-section-type="product"
        data-section-settings='{
              "enableHistoryState": true,
              "templateSuffix": "",
              "showInventoryQuantity": false,
              "showSku": false,
              "stackProductImages": false,
              "showThumbnails": true,
              "inventoryQuantityThreshold": 3,
              "showPriceInButton": false,
              "enableImageZoom": true,
              "showPaymentButton": false,
              "useAjaxCart": true
            }'>
        <div class="Product__Wrapper">
            <div class="Product__Gallery Product__Gallery--withThumbnails">
                <div class="gallery">
                    <div class="thumbnails">
                        @foreach ($product->images as $item)
                            <div class="item">
                                <img src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" alt="">
                            </div>
                        @endforeach
                        </div>

                    <div class="main">
                        <img src="{{ getImage($product->image, 'products/' . $product->product_code) }}" />
                    </div>
                </div>
            </div>
            <div class="Product__InfoWrapper">
                <div class="Product__Info">
                    <div class="Container">
                        <div class="ProductMeta">
                            <div class="ProductMeta__PriceList Heading">{{ $product->product_code }}</div>
                            <h2 class="ProductMeta__Vendor Heading u-h6">
                                {{ $product->detail->brand->brand_title }}</h2>
                            <h1 class="ProductMeta__Title Heading u-h2">{{ $product->product_name }}</h1>
                            <div class="ProductMeta__PriceList Heading">
                                <span class="ProductMeta__Price Price Text--subdued u-h4"
                                    data-money-convertible>
                                    @if ($product->detail->discount_percentage > 0)
                                        <span class="money">
                                            RP.
                                            <del id="retail">
                                                {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                            </del>
                                            <span style="position:inherit; font-weight: 800;" id="discount">
                                                {{ rupiah_format(intval($product->detail->after_discount_price ?? 0)) }}
                                            </span>
                                        </span>
                                        <div style="color: red; font-size: 20px; font-weight: bold;">
                                            <span id="percentage">{{ $product->detail->discount_percentage }}</span>
                                            % OFF
                                        </div>
                                        @else
                                        <span class="money">RP.
                                            <span id="retail">
                                                {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                            </span>
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div style="margin: 50px;"></div>
                        <div class="size-button Heading u-h6" style="display: flex; justify-content: space-between;">
                            <ul class="donate-now">

                                @foreach ($size as $item)
                                    <li class="size-item">
                                        <input type="radio" id="size" name="size" value="{{$item->size}}" data-id="{{$item->id}}" data-price="{{ rupiah_format(intval($item->retail_price ?? 0))}}"
                                        data-discount-price="{{rupiah_format(intval($item->after_discount_price ?? 0))}}" data-discount="{{$item->discount_percentage}}"
                                        data-qty="{{$item->qty}}"/>
                                        <label class="btn btn-default" for="a25">{{ $item->size }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            {{-- <label for="">Size Available : </label> --}}
                            {{-- <select name="size" id="size" class="size-select">
                                <option>Select Size</option>
                                @foreach ($size as $item)
                                    <option value="{{$item->size}}" data-id="{{$item->id}}"" data-price="{{ rupiah_format(intval($item->retail_price ?? 0))}}"
                                        data-discount-price="{{rupiah_format(intval($item->after_discount_price ?? 0))}}" data-discount="{{$item->discount_percentage}}"
                                        data-qty="{{$item->qty}}">{{$item->size}}</option>
                                @endforeach
                            </select> --}}
                            <!-- <a href="{{ route('size-chart') }}" target="_blank" style="align-self: center">Size Chart</a> -->
                        </div>
                        <div style="margin: 5px 0">

                            {{-- @if($product->details()->count() > 1)
                            @foreach ($product->details()->get() as $item)
                                <a href="javascript:void(0)" onclick="changePrice(this)" data-id="{{$item->id}}"" data-price="{{$item->retail_price}}"
                                    data-discount-price="{{$item->after_discount_price}}" data-discount="{{$item->discount_percentage}}"
                                    data-qty="{{$item->qty}}"
                                    class="Button Button--primary size" style="font-size: 12px; padding: 5px 15px;" id="size-{{$item->id}}">
                                    <span>{{$item->size}}</span>
                                </a>
                            @endforeach
                            @endif --}}
                        </div>
                        <div style="width: 100%;">
                            <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                href="{{ $product->product_link }}" target="_blank"
                                class="ProductForm__AddToCart Button Button--primary Button--full">
                                <span>ORDER VIA TOKOPEDIA</span>
                            </a>
                        </div>
                        @if($product->shopee_link)
                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>
                            <div style="width: 100%;">
                                <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                    href="{{ $product->shopee_link }}" target="_blank"
                                    class="ProductForm__AddToCart Button Button--primary Button--full">
                                    <span>ORDER VIA SHOPEE</span>
                                </a>
                            </div>
                        @endif
                        @if($product->blibli_link)
                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>
                            <div style="width: 100%;">
                                <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                    href="{{ $product->blibli_link }}" target="_blank"
                                    class="ProductForm__AddToCart Button Button--primary Button--full">
                                    <span>ORDER VIA BLIBLI</span>
                                </a>
                            </div>
                        @endif
                        <div style="height: 10px;">
                            <span class="h-2"></span>
                        </div>
                        <div style="width: 100%;">
                            <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                href="http://wa.me/6289617925925" target="_blank"
                                class="ProductForm__AddToCart Button Button--primary Button--full">
                                <span>ORDER VIA WHATSAPP</span>
                            </a>
                        </div>

                        <div class="Product__OffScreen"></div>

                        @include('store-theme._partials._product', $product)

                        <div class="ProductMeta__Description">
                            <div class="Rte">
                                <div>
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Product__ActionList hidden-pocket">
                    <div class="Product__ActionItem hidden-lap-and-up">
                        <button class="RoundButton RoundButton--small RoundButton--flat"
                            data-action="open-product-zoom">
                            <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                <g stroke="currentColor" fill="none" fill-rule="evenodd"
                                    stroke-linecap="square">
                                    <path d="M8,1 L8,15"></path>
                                    <path d="M1,8 L15,8"></path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <!-- Background of PhotoSwipe -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">
            <!-- Container that holds slides. Do not remove as content is dynamically added -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Main UI bar -->
            <div class="pswp__ui pswp__ui--hidden">
                <button class="pswp__button pswp__button--prev RoundButton" data-animate-left
                    title="Previous (left arrow)">
                    <svg class="Icon Icon--arrow-left" role="presentation" viewBox="0 0 11 21">
                        <polyline fill="none" stroke="currentColor" points="10.5 0.5 0.5 10.5 10.5 20.5"
                            stroke-width="1.25"></polyline>
                    </svg>
                </button>
                <button class="pswp__button pswp__button--close RoundButton RoundButton--large"
                    data-animate-bottom title="Close (Esc)">
                    <svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                        <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd">
                        </path>
                    </svg>
                </button>
                <button class="pswp__button pswp__button--next RoundButton" data-animate-right
                    title="Next (right arrow)">
                    <svg class="Icon Icon--arrow-right" role="presentation" viewBox="0 0 11 21">
                        <polyline fill="none" stroke="currentColor" points="0.5 0.5 10.5 10.5 0.5 20.5"
                            stroke-width="1.25"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('js/lightslider.min.js') }}" defer></script>
    <script>
        document.querySelectorAll('.thumbnails .item img').forEach(img => {
            img.addEventListener('mouseover', () => {
                // console.log(img);
                document.querySelector('.main img').src = img.src;
            });
        });

        var product_variants_removed = [];

        $(".pop").on("click", function(e) {
            e.preventDefault();
            // $('#imagemodal').attr('src', $('#imageresource'+id).attr('src')); // here asign the image to the modal when the user click the enlarge link
            $('#sizeModal').modal(
            'show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });

        $(document).ready(function() {
            $('.size-item').click(function() {
                console.log($(this).find('#size:checked').attr('data-price'));
                $('#retail').text($(this).find('#size:checked').attr('data-price'));
                $('#discount').text($(this).find('#size:checked').attr('data-discount-price'));
                $('#percentage').text($(this).find('#size:checked').attr('data-discount'));
            });
        });

        $(document).ready(function() {
            $('#vertical').lightSlider({
            gallery:true,
            item:1,
            vertical:true,
            verticalHeight:295,
            vThumbWidth:50,
            thumbItem:8,
            thumbMargin:4,
            slideMargin:0
            });
        });

        $(document).ready(function() {
            $('#vertical').lightSlider({
            gallery:true,
            item:1,
            vertical:true,
            verticalHeight:295,
            vThumbWidth:50,
            thumbItem:8,
            thumbMargin:4,
            slideMargin:0
            });
        });
    </script>
@endpush
