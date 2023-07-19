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
                 <span id="ProductGallery" class="Anchor"></span>
                 <div class="Product__ActionList hidden-lap-and-up">
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
                 <div class="Product__Slideshow Product__Slideshow--zoomable Carousel" data-flickity-config='{
                         "prevNextButtons": false,
                         "pageDots": true,
                         "adaptiveHeight": true,
                         "watchCSS": true,
                         "dragThreshold": 8,
                         "initialIndex": 0,
                         "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                       }' wire:ignore>
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
                             <noscript>
                                 <img src="{{ getImage($product->image, 'products/' . $product->product_code) }}"
                                     alt='{{ $product->product_name }}' />
                             </noscript>
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
                                     <noscript>
                                         <img src="/{{ getImage($item->image_url, 'products/' . $product->product_code) }}"
                                             alt='{{ $product->product_name }}' />
                                     </noscript>
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
                                     @if (intval($showDiscountPrice) > 0)
                                         <span class="money">
                                             RP.
                                             <del id="retail">
                                                 {{ rupiah_format(intval($showRetailPrice != 0 ? $showRetailPrice : 0)) }}
                                             </del>
                                             <span style="position:inherit; font-weight: 800;" id="discount">
                                                 {{ rupiah_format(intval($showDiscountPrice != 0 ? $showDiscountPrice : 0)) }}
                                             </span>
                                         </span>
                                         <div style="color: red; font-size: 20px; font-weight: bold;">
                                             <span id="percentage">{{ $showDiscountPercentage != 0 ? $showDiscountPercentage : 0 }}</span>
                                             % OFF
                                         </div>
                                         @else
                                         <span class="money">RP.
                                             <span id="retail">
                                                 {{ rupiah_format(intval($showRetailPrice != 0 ? $showRetailPrice : 0)) }}
                                             </span>
                                         </span>
                                     @endif
                                 </span>
                             </div>
                         </div>
                         <div style="margin: 5px;"></div>
                         <div class="size-button Heading u-h6" style="text-align: right;">
                             {{-- <label for="">Size Available : </label> --}}
                             {{-- <select name="size" id="size" class="size-select">
                                 <option>Select Size</option>
                                 @foreach ($sizeList as $item)
                                     <option value="{{$item->id}}" data-id="{{$item->id}}"" data-price="{{ rupiah_format(intval($item->retail_price ?? 0))}}"
                                         data-discount-price="{{rupiah_format(intval($item->after_discount_price ?? 0))}}" data-discount="{{$item->discount_percentage}}"
                                         data-qty="{{$item->qty}}" wire:change="updatePrice($event.target.value)">{{$item->size}}</option>
                                 @endforeach
                             </select> --}}
                             <a href="{{ route('size-chart') }}" target="_blank" style="align-self: center">Size Chart</a>
                         </div>
                         @livewire('product-selection-modal')
                         <div style="margin: 5px;"></div>
                         <div class="size-button Heading u-h6" style="display: flex; justify-content: space-between;">
                            {{-- <label for="">Size Available : </label> --}}
                            <p id="id_work_days">
                                @foreach ($sizeList as $index => $item)
                                    @if($item->size != null || $item->size != '')
                                    <label class="sizes-option"><input type="radio" name="work_days" value="{{$item->id}}" data-size-id="{{ $item->id }}" wire:change="updatePrice($event.target.value)" {{ $item->qty == 0 ? 'disabled' : ''}}
                                        {{-- {{ $index == 0 ? 'checked' : ''}} --}}
                                        ><span>{{$item->size ?? 'All Size'}}</span></label>
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
                                class="ProductForm__AddToCart Button Button--primary Button--full" wire:click="addToCart" {{ $can_buy ? '' : 'disabled'}} @if (!$can_buy) title="size is not set" @endif>
                                <span>ADD TO CART</span>
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

                         @include('display-store.store-theme._partials._product', $product)

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
</div>
