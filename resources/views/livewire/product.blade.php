<div>
    {{-- Be like water. --}}
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
                                <img class="image" src="{{ getImage($product->image, 'products/' . $product->product_code) }}" alt="">
                            </div>
                            @endforeach
                        </div>

                        <div class="main">
                            <img class="main-image" style="border-radius: 33px;" src="{{ getImage($product->image, 'products/' . $product->product_code) }}" />
                        </div>
                    </div>
                    <div class="mobile-gallery" style="display: none;">
                        <span id="ProductGallery" class="Anchor"></span>
                        {{-- <div class="Product__ActionList hidden-lap-and-up">
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
                    </div> --}}
                        <div class="Product__Slideshow Product__Slideshow--zoomable Carousel" data-flickity-config='{
                            "prevNextButtons": false,
                            "pageDots": true,
                            "adaptiveHeight": true,
                            "watchCSS": true,
                            "dragThreshold": 8,
                            "initialIndex": 0,
                            "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                        }'>
                            @php
                            $index = 1;
                            $image_size = getimagesize(getImage($product->image, 'products/' . $product->product_code));
                            $ratio_main_image = $image_size[0] / $image_size[1];
                            @endphp
                            <div id="image-{{ $product->product_code }}-0" class="Product__SlideItem Product__SlideItem--image Carousel__Cell"
                                data-image-position-ignoring-video="0" data-image-position="0" data-image-id="image-{{ $product->product_code }}-0">
                                <div class="AspectRatio AspectRatio--withFallback"
                                    style="padding-bottom: 100%; --aspect-ratio: {{ $ratio_main_image }};">
                                    <img class="Image--lazyLoad Image--fadeIn"
                                        data-src="{{ getImage($product->image, 'products/' . $product->product_code) }}"
                                        data-widths="[200,400,600,700,800,900,1000,1200,1400,1600]" data-sizes="auto"
                                        data-expand="-100" alt='{{ $product->product_name }}' data-max-width="2000"
                                        data-max-height="2000"
                                        data-original-src="{{ getImageGallery($product->image, 'products/' . $product->product_code) }}" />

                                    <span class="Image__Loader"></span>
                                </div>
                            </div>
                            @foreach ($product->images as $item)
                            @if ($product->image != $item->image_url)
                            <div id="image-{{ $product->product_code }}-{{ $index}}"
                                class="Product__SlideItem Product__SlideItem--image Carousel__Cell"
                                data-image-position-ignoring-video="{{ $index }}" data-image-position="{{ $index }}"
                                data-image-id="image-{{ $product->product_code }}-{{ $index }}">
                                @php
                                $image_size = getimagesize(getImage($item->image_url, 'products/' . $product->product_code));
                                $ratio = $image_size[0] / $image_size[1];
                                @endphp
                                <div class="AspectRatio AspectRatio--withFallback"
                                    style="padding-bottom: 100%; --aspect-ratio: {{ $ratio }};">
                                    <img class="Image--lazyLoad Image--fadeIn"
                                        data-src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}"
                                        data-widths="[200,400,600,700,800,900,1000,1200,1400,1600]"
                                        data-sizes="auto" data-expand="-100"
                                        alt='{{ $product->product_name }}' data-max-width="2000"
                                        data-max-height="2000"
                                        data-original-src="{{ getImageGallery($item->image_url, 'products/' . $product->product_code) }}" />

                                    <span class="Image__Loader"></span>
                                </div>
                            </div>
                            @php
                            $index++;
                            @endphp
                            @endif
                            @endforeach
                        </div>
                        <div class="Product__SlideshowNav Product__SlideshowNav--thumbnails">
                            <div class="Product__SlideshowNavScroller">
                                @php
                                $index = 1;
                                @endphp
                                <span data-index="0" data-image-id="0"
                                    class="Product__SlideshowNavImage AspectRatio is-selected"
                                    style="--aspect-ratio: {{ $ratio_main_image }};">
                                    <img src="{{ getImage($product->image, 'products/' . $product->product_code) }}" />
                                </span>
                                @foreach ($product->images as $key => $item)
                                @if ($product->image != $item->image_url)
                                @php
                                $image_size = getimagesize(getImage($item->image_url, 'products/' . $product->product_code));
                                $ratio_image = $image_size[0] / $image_size[1];
                                @endphp
                                <span data-index="{{ $index }}" data-image-id="image-{{ $product->product_code }}-{{ $index }}"
                                    class="Product__SlideshowNavImage AspectRatio"
                                    style="--aspect-ratio: {{ $ratio_image }};">
                                    <img
                                        src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" />
                                </span>
                                @php
                                $index++;
                                @endphp
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Product__InfoWrapper">
                <div class="Product__Info">
                    <div class="Container">
                        <div class="ProductMeta">
                            <span class="ProductMeta__PriceList Heading" style="font-weight: lighter;">
                                {{ $product->product_code }}
                                / {{ $product->detail->brand->brand_title }}
                            </span>
                            <h1 class="ProductMeta__Title Heading u-h2" style="color: #000; font-size: 30px; font-weight: 800;">{{ $product->product_name }}</h1>
                            <div class="ProductMeta__Description" style="color: #000;">
                                <div>
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                        <div style="margin: 5px;"></div>
                        <div class="size-button Heading u-h6 SizeLabel" style="text-align: right;">
                            {{-- <label for="">Size Available : </label> --}}
                            {{-- <select name="size" id="size" class="size-select">
                                 <option>Select Size</option>
                                 @foreach ($sizeList as $item)
                                     <option value="{{$item->id}}" data-id="{{$item->id}}"" data-price="{{ rupiah_format(intval($item->retail_price ?? 0))}}"
                            data-discount-price="{{rupiah_format(intval($item->after_discount_price ?? 0))}}" data-discount="{{$item->discount_percentage}}"
                            data-qty="{{$item->qty}}" wire:change="updatePrice($event.target.value)">{{$item->size}}</option>
                            @endforeach
                            </select> --}}
                            <p style="align-self: center; color: #000;" class="SelectSizeLabel">Select Size</p>
                            <a href="{{ route('size-chart') }}" target="_blank" style="align-self: center; color: #000;" class="SizeChartLabel">Size Chart</a>
                        </div>
                        @livewire('product-selection-modal')
                        <div style="margin: 5px;"></div>
                        <div class="size-button Heading u-h6" style="display: flex; justify-content: space-between;">
                            {{-- <label for="">Size Available : </label> --}}
                            <p id="id_work_days">
                                @foreach ($sizeList as $index => $item)
                                @if($item->size != null || $item->size != '')
                                <label class="sizes-option"><input type="radio" name="work_days" value="{{$item->id}}" data-size-id="{{ $item->id }}" {{ $item->qty == 0 ? 'disabled' : ''}}
                                        {{-- {{ $index == 0 ? 'checked' : ''}} --}}><span>{{$item->size ?? 'All Size'}}</span></label>
                                @endif
                                @endforeach
                            </p>
                            {{-- <a href="#" class="Button {{ $item->qty == 0 ? 'Size__Button_Disabled' : 'Size__Button '}}" value="" {{ $item->qty == 0 ? 'disabled' : ''}}></a> --}}
                            {{-- <select name="size" id="size" class="size-select" wire:change="updatePrice($event.target.value)">
                                <option value="">Select Size</option>
                                @foreach ($product->details()->get() as $item)
                                    <option value="{{$item->id}}">{{$item->size ?? 'All Size'}}</option>
                            @endforeach
                            </select> --}}
                        </div>
                        <div class="ProductMeta__PriceList Heading">
                            <span class="ProductMeta__Price Price Text--subdued u-h4" data-money-convertible>
                                @if (intval($showDiscountPrice) > 0)
                                <div class="PriceWrapper">
                                    <div class="">
                                        <span class="money" style="font-size: 20px; color: #EA501F; font-weight: bold;">
                                            RP.
                                            <del id="retail">
                                                {{ rupiah_format(intval($showRetailPrice != 0 ? $showRetailPrice : 0)) }}
                                            </del>
                                        </span>
                                    </div>
                                    <div style="color: #EA501F; font-size: 20px;">
                                        <span id="percentage">{{ $showDiscountPercentage != 0 ? $showDiscountPercentage : 0 }}</span> % OFF
                                    </div>
                                </div>

                                <span class="money" style="font-size: 30px; color: #000; font-weight: 800;">
                                    RP.
                                    <span style="position:inherit;" id="discount">
                                        {{ rupiah_format(intval($showDiscountPrice != 0 ? $showDiscountPrice : 0)) }}
                                    </span>
                                </span>
                                @else
                                <span class="money">
                                    RP.
                                    <span id="retail">
                                        {{ rupiah_format(intval($showRetailPrice != 0 ? $showRetailPrice : 0)) }}
                                    </span>
                                </span>
                                @endif
                            </span>
                        </div>

                        <div style="margin: 5px 0">
                            <div style="width: 100%;">
                                @php
                                $can_buy = true;
                                if( count($sizeList) < 2 && ($sizeList[0]->size == null || $sizeList[0]->size == '')) {
                                    $can_buy = false;
                                    }
                                    @endphp
                                    <input class="mb-2 border-2 rounded" type="hidden" value="1" min="1" wire:model="quantity">
                                    <button data-spiff-hide data-product-id="{{ $product->product_code }}" data-product-image="{{ getImage($product->image, 'products/' . $product->product_code) }}"
                                        class="ProductForm__AddToCart Button Button--cart Button--full" wire:click="addToCart" {{ $can_buy ? '' : 'disabled'}} @if (!$can_buy) title="size is not set" @endif>
                                        <span>ADD TO CART</span>
                                        <span class="hidden-tablet-and-up">
                                            <svg class="Icon Icon--cart" role="presentation" viewBox="0 0 17 20">
                                                <path d="M0 20V4.995l1 .006v.015l4-.002V4c0-2.484 1.274-4 3.5-4C10.518 0 12 1.48 12 4v1.012l5-.003v.985H1V19h15V6.005h1V20H0zM11 4.49C11 2.267 10.507 1 8.5 1 6.5 1 6 2.27 6 4.49V5l5-.002V4.49z" fill="currentColor">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="hidden-phone">
                                            <svg class="Icon Icon--cart-desktop" role="presentation" viewBox="0 0 19 23">
                                                <path d="M0 22.985V5.995L2 6v.03l17-.014v16.968H0zm17-15H2v13h15v-13zm-5-2.882c0-2.04-.493-3.203-2.5-3.203-2 0-2.5 1.164-2.5 3.203v.912H5V4.647C5 1.19 7.274 0 9.5 0 11.517 0 14 1.354 14 4.647v1.368h-2v-.912z" fill="currentColor">
                                                </path>
                                            </svg>
                                        </span>
                                        </span>
                                    </button>
                            </div>

                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>

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
                            @if($product->shopee_link)
                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>
                            <div style="width: 100%;">
                                <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                    href="{{ $product->shopee_link }}" target="_blank"
                                    class="ProductForm__AddToCart Button Button--shop Button--full">
                                    <span>ORDER VIA SHOPEE</span>
                                </a>
                            </div>
                            @endif
                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>
                            <div style="width: 100%;">
                                <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                    href="{{ $product->product_link }}" target="_blank"
                                    class="ProductForm__AddToCart Button Button--shop Button--full">
                                    <span>ORDER VIA TOKOPEDIA</span>
                                </a>
                            </div>
                            @if($product->tiktok_link)
                            <div style="height: 10px;">
                                <span class="h-2"></span>
                            </div>
                            <div style="width: 100%;">
                                <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                    href="{{ $product->tiktok_link }}" target="_blank"
                                    class="ProductForm__AddToCart Button Button--shop Button--full">
                                    <span>ORDER VIA TIKTOK</span>
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
                                    class="ProductForm__AddToCart Button Button--shop Button--full">
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
                                    class="ProductForm__AddToCart Button Button--shop Button--full">
                                    <span>ORDER VIA WHATSAPP</span>
                                </a>
                            </div>

                            <div class="Product__OffScreen"></div>

                            @include('display-store.store-theme._partials._product', $product)
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

    <div class="RelatedProductsWrapper">
        <button class="pswp__button pswp__button--prev RoundButton arrow left hidden" data-animate-left
            title="Previous (left arrow)">
            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.245897 8.10589C0.0877485 7.94628 -0.000976562 7.73068 -0.000976562 7.50599C-0.000976562 7.2813 0.0877485 7.0657 0.245897 6.90609L5.90533 1.24666C5.98305 1.16325 6.07677 1.09636 6.1809 1.04996C6.28503 1.00356 6.39745 0.978614 6.51143 0.976603C6.62541 0.974591 6.73864 0.995558 6.84434 1.03825C6.95005 1.08095 7.04607 1.1445 7.12668 1.22511C7.20729 1.30572 7.27084 1.40175 7.31354 1.50745C7.35623 1.61316 7.3772 1.72638 7.37519 1.84036C7.37318 1.95434 7.34823 2.06676 7.30183 2.17089C7.25543 2.27502 7.18853 2.36874 7.10513 2.44646L2.89451 6.65708L14.4284 6.65708C14.6536 6.65708 14.8695 6.74652 15.0287 6.90572C15.1879 7.06492 15.2773 7.28085 15.2773 7.50599C15.2773 7.73114 15.1879 7.94706 15.0287 8.10627C14.8695 8.26547 14.6536 8.35491 14.4284 8.35491H2.89451L7.10513 12.5655C7.25508 12.7265 7.33672 12.9393 7.33284 13.1592C7.32896 13.3792 7.23986 13.589 7.08433 13.7445C6.92879 13.9001 6.71896 13.9892 6.49903 13.993C6.2791 13.9969 6.06626 13.9153 5.90533 13.7653L0.245897 8.10589Z" fill="black" />
            </svg>

        </button>

        <div class="RelatedProductsHeader">
            <h3 class="RelatedProductTitle">Related Products</h3>
            <a href="{{ url('/collections/all') }}" class="ViewAllBtn">
                <span style="color: #000;">View All</span>
                <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.8088 7.59954C15.9669 7.43994 16.0557 7.22434 16.0557 6.99964C16.0557 6.77495 15.9669 6.55935 15.8088 6.39974L10.1494 0.740312C10.0716 0.656907 9.97792 0.590011 9.87379 0.543612C9.76965 0.497213 9.65724 0.472266 9.54326 0.470255C9.42927 0.468244 9.31605 0.48921 9.21035 0.531906C9.10464 0.574602 9.00862 0.638152 8.92801 0.718763C8.8474 0.799376 8.78385 0.895398 8.74115 1.0011C8.69846 1.10681 8.67749 1.22003 8.6795 1.33401C8.68151 1.448 8.70646 1.56041 8.75286 1.66454C8.79926 1.76867 8.86615 1.8624 8.94956 1.94011L13.1602 6.15073L1.62625 6.15073C1.40111 6.15073 1.18518 6.24017 1.02598 6.39937C0.866776 6.55857 0.777338 6.7745 0.777338 6.99964C0.777338 7.22479 0.866776 7.44072 1.02598 7.59992C1.18518 7.75912 1.40111 7.84856 1.62625 7.84856L13.1602 7.84856L8.94956 12.0592C8.79961 12.2201 8.71797 12.433 8.72185 12.6529C8.72573 12.8728 8.81482 13.0826 8.97036 13.2382C9.1259 13.3937 9.33573 13.4828 9.55566 13.4867C9.77559 13.4906 9.98843 13.4089 10.1494 13.259L15.8088 7.59954Z" fill="black" />
                </svg>
            </a>
        </div>

        <div class="RelatedProductsSlider">
            @if ($related_products->count() > 0)
            @foreach ($related_products as $product)
            @php
            $image_size = getimagesize(getImage($product->image, 'products/'.$product->product_code));
            $ratio = $image_size[0] / $image_size[1];
            @endphp
            <div class="ProductCard">
                <a href="{{ route('product-detail', [$product->id, str_replace(' ', '_', $product->product_name)]) }}">
                    <div class="ProductImageWrapper" style="--aspect-ratio: {{ $ratio }}">
                        <img src="{{ getImage($product->image, 'products/' . $product->product_code) }}"
                            alt="{{ $product->product_name }}">

                        <button type="" class="CartIconBtn">
                            <!-- Inline SVG Cart Icon -->
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5H12V4C12 2.93913 11.5786 1.92172 10.8284 1.17157C10.0783 0.421427 9.06087 0 8 0C6.93913 0 5.92172 0.421427 5.17157 1.17157C4.42143 1.92172 4 2.93913 4 4V5H1C0.734784 5 0.48043 5.10536 0.292893 5.29289C0.105357 5.48043 0 5.73478 0 6V17C0 17.7956 0.316071 18.5587 0.87868 19.1213C1.44129 19.6839 2.20435 20 3 20H13C13.7956 20 14.5587 19.6839 15.1213 19.1213C15.6839 18.5587 16 17.7956 16 17V6C16 5.73478 15.8946 5.48043 15.7071 5.29289C15.5196 5.10536 15.2652 5 15 5ZM6 4C6 3.46957 6.21071 2.96086 6.58579 2.58579C6.96086 2.21071 7.46957 2 8 2C8.53043 2 9.03914 2.21071 9.41421 2.58579C9.78929 2.96086 10 3.46957 10 4V5H6V4ZM14 17C14 17.2652 13.8946 17.5196 13.7071 17.7071C13.5196 17.8946 13.2652 18 13 18H3C2.73478 18 2.48043 17.8946 2.29289 17.7071C2.10536 17.5196 2 17.2652 2 17V7H4V8C4 8.26522 4.10536 8.51957 4.29289 8.70711C4.48043 8.89464 4.73478 9 5 9C5.26522 9 5.51957 8.89464 5.70711 8.70711C5.89464 8.51957 6 8.26522 6 8V7H10V8C10 8.26522 10.1054 8.51957 10.2929 8.70711C10.4804 8.89464 10.7348 9 11 9C11.2652 9 11.5196 8.89464 11.7071 8.70711C11.8946 8.51957 12 8.26522 12 8V7H14V17Z" fill="#AABACA" />
                            </svg>

                        </button>
                    </div>
                </a>
                <div class="ProductInfo">
                    <div class="ProductPrice">
                        <h4 class="ProductName">{{ $product->product_name }}</h4>
                        @if ($product->after_discount_price > 0 && $product->after_discount_price < $product->retail_price)
                            <span class="PriceOriginal"><del>Rp {{ rupiah_format(intval($product->retail_price ?? 0)) }}</del></span>
                            <span class="PriceOff">{{ 100 - round((intval($product->after_discount_price) / intval($product->retail_price)) * 100, 0) }}% OFF</span>
                            <p class="PriceDiscounted">Rp {{ rupiah_format(intval($product->after_discount_price ?? 0)) }}</p>
                            @else
                            <span class="PriceNormal">Rp {{ rupiah_format(intval($product->retail_price ?? 0)) }}</span>
                            @endif
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>No Data Available</p>
            @endif
        </div>

        <button class="pswp__button pswp__button--prev RoundButton arrow right hidden" data-animate-right
            title="Previous (right arrow)">
            <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8977 8.10589C16.0558 7.94628 16.1445 7.73068 16.1445 7.50599C16.1445 7.2813 16.0558 7.0657 15.8977 6.90609L10.2382 1.24666C10.1605 1.16325 10.0668 1.09636 9.96265 1.04996C9.85852 1.00356 9.74611 0.978614 9.63212 0.976603C9.51814 0.974591 9.40492 0.995558 9.29921 1.03825C9.19351 1.08095 9.09749 1.1445 9.01688 1.22511C8.93626 1.30572 8.87271 1.40175 8.83002 1.50745C8.78732 1.61316 8.76636 1.72638 8.76837 1.84036C8.77038 1.95434 8.79533 2.06676 8.84172 2.17089C8.88812 2.27502 8.95502 2.36874 9.03843 2.44646L13.249 6.65708L1.71512 6.65708C1.48997 6.65708 1.27405 6.74652 1.11485 6.90572C0.955644 7.06492 0.866205 7.28085 0.866205 7.50599C0.866205 7.73114 0.955644 7.94706 1.11485 8.10627C1.27405 8.26547 1.48997 8.35491 1.71512 8.35491H13.249L9.03843 12.5655C8.88847 12.7265 8.80684 12.9393 8.81072 13.1592C8.8146 13.3792 8.90369 13.589 9.05923 13.7445C9.21476 13.9001 9.4246 13.9892 9.64453 13.993C9.86445 13.9969 10.0773 13.9153 10.2382 13.7653L15.8977 8.10589Z" fill="black" />
            </svg>

        </button>
    </div>

    @push('scripts')
  <script>
     function initRelatedSlider() {
        const slider = document.querySelector(".RelatedProductsSlider");

        // Use querySelector with your classes
        const leftBtn = document.querySelector(".pswp__button.pswp__button--prev.RoundButton.arrow.left");
        const rightBtn = document.querySelector(".pswp__button.pswp__button--prev.RoundButton.arrow.right");

        if (slider && leftBtn && rightBtn) {
            // Only show arrows if more than 5 products
            if (slider.children.length > 5) {
                leftBtn.classList.remove("hidden");
                rightBtn.classList.remove("hidden");
            }

            leftBtn.onclick = () => slider.scrollBy({ left: -250, behavior: "smooth" });
            rightBtn.onclick = () => slider.scrollBy({ left: 250, behavior: "smooth" });
        }
    }

    // Run when Livewire loads & re-renders
    document.addEventListener("livewire:load", initRelatedSlider);
    Livewire.hook("message.processed", initRelatedSlider);
</script>
    @endpush

</div>
