@push('styles')
    <style>
        #filter_button {
            display: none !important;
        }

        @media only screen and (max-width: 1007px) {
           .Drawer__Main {
                padding-top: 15px;
                padding-left: 20px !important;
            }

            .filter-button {
                display: block;
            }
        }

        .Drawer__Main {
            padding-left: 20px !important;
        }
    </style>
@endpush
<div>
    <div class="CollectionMain" style="padding-top: 1rem; padding-botom: 5rem; margin-bottom: 5rem;">
        <div class="CollectionToolbar CollectionToolbar--top CollectionToolbar--reverse">
            <div class="CollectionToolbar__Group">
                <a class="CollectionToolbar__Item CollectionToolbar__Item--filter Heading Text--subdued u-h6 filter-button " data-action="open-drawer" data-drawer-id="collection-filter-drawer" aria-label="Show filters" aria-expanded="false" id="filter_button">
                    Filter
                </a>
                <a class="CollectionToolbar__Item CollectionToolbar__Item--sort Heading Text--subdued u-h6 sort-button"
                    aria-label="Show sort by" aria-haspopup="true" aria-expanded="false"
                    aria-controls="collection-sort-popover">
                    Sort
                    <svg class="Icon Icon--select-arrow" role="presentation" viewBox="0 0 19 12">
                        <polyline fill="none" stroke="currentColor" points="17 2 9.5 10 2 2" fill-rule="evenodd"
                            stroke-width="2" stroke-linecap="square"></polyline>
                    </svg>
                </a>
            </div>
            <div id="collection-filter-drawer" class="CollectionFilters Drawer Drawer--secondary Drawer--fromRight" aria-hidden="true">
                <header class="Drawer__Header Drawer__Header--bordered Drawer__Header--center Drawer__Container">
                  <span class="Drawer__Title Heading u-h4">Filters</span>
                    <a class="Drawer__Close Icon-Wrapper--clickable close-filter" data-action="close-drawer" data-drawer-id="collection-filter-drawer" aria-label="Close navigation">
                        <svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                            <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                        </svg>
                    </a>
                </header>
                <div class="Drawer__Content">
                  <div class="Drawer__Main" style="padding-left: 20px !important;" data-scrollable>
                    @include('components.filters', $filters)
                  </div>
                </div>
            </div>
            <div id="collection-sort-popover" class="Popover Popover--positionBottom Popover--alignRight" aria-hidden="true" style="top: 233px; right: 0px;">
                <header class="Popover__Header">
                    <a class="Popover__Close Icon-Wrapper--clickable" data-action="close-popover"><svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                        <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                        </svg>
                    </a>
                    <span class="Popover__Title Heading u-h4">Sort</span>
                </header>
                <div class="Popover__Content">
                    <div class="Popover__ValueList">
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('product_name', 'ASC')">
                        Alphabetically, A-Z
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('product_name', 'DESC')">
                        Alphabetically, Z-A
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('pd.retail_price', 'ASC')">
                        Price, low to high
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('pd.retail_price', 'DESC')">
                        Price, high to low
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('pd.after_discount_price', 'ASC')">
                        Discount Price, low to high
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('pd.after_discount_price', 'DESC')">
                        Disount Price, high to low
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('created_at', 'ASC')">
                        Date, old to new
                        </a>
                        <a class="Popover__Value  Heading Link Link--primary u-h6" wire:click="sort('created_at', 'DESC')">
                        Date, new to old
                        </a>
                    </div>
                </div>
            </div>
            <div class="Search__SearchBar" style="margin-left: 20px; width: 100%;">
                <div class="Search__InputIconWrapper">
                    <span class="hidden-tablet-and-up"><svg class="Icon Icon--search" role="presentation"
                            viewBox="0 0 18 17">
                            <g transform="translate(1 1)" stroke="currentColor" fill="none" fill-rule="evenodd"
                                stroke-linecap="square">
                                <path d="M16 16l-5.0752-5.0752"></path>
                                <circle cx="6.4" cy="6.4" r="6.4"></circle>
                            </g>
                        </svg></span>
                    <span class="hidden-phone">
                        <svg class="Icon Icon--search-desktop" role="presentation"
                            viewBox="0 0 21 21">
                            <g transform="translate(1 1)" stroke="currentColor" stroke-width="2" fill="none"
                                fill-rule="evenodd" stroke-linecap="square">
                                <path d="M18 18l-5.7096-5.7096"></path>
                                <circle cx="7.2" cy="7.2" r="7.2"></circle>
                            </g>
                        </svg>
                    </span>
                </div>

                <input wire:model="search" type="text" class="Search__Input Heading ui-autocomplete-input"
                    autocomplete="off" autocorrect="off" autocapitalize="off" placeholder="Search..."
                    autofocus="" >
            </div>
        </div>
        <div class="CollectionInner">
            <div class="CollectionInner__Sidebar CollectionInner__Sidebar--withTopToolbar hidden-pocket"
                style="top: -4.0625px;">
                @include('components.filters', $filters)
            </div>
            <div class="CollectionInner__Products">
                <div class="ProductListWrapper">
                    <div class="ProductList ProductList--grid ProductList--removeMargin Grid" data-mobile-count="2"
                        data-desktop-count="4">
                        @foreach ($products as $product)
                        @php
                            $image_size = getimagesize(getImage($product->image, 'products/'.$product->product_code));
                            $ratio = $image_size[0] / $image_size[1];
                        @endphp
                            <div class="Grid__Cell 1/2--phone 1/3--tablet-and-up 1/4--desk SOCKS">
                                <div class="ProductItem" style="visibility: visible;">
                                    <a href="{{ route('product-detail', [$product->id, str_replace(' ', '_', $product->product_name)]) }}"
                                        class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                        <div class="AspectRatio AspectRatio--withFallback"
                                            style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: {{$ratio}};">

                                            {{-- multi image --}}
                                            @foreach ($product->images()->limit(2)->get() as $key => $image)
                                                @if($product->image != $image->image_url)
                                                    <img class="ProductItem__Image ProductItem__Image--alternate Image--lazyLoad Image--fadeIn"
                                                    {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                                                        data-src="{{ getImage($image->image_url, 'products/'.$product->product_code) }}"
                                                        data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                                                        alt='{{$product->product_name}}' data-image-id="{{$image->id}}" />
                                                @endif
                                            @endforeach

                                            <img class="ProductItem__Image Image--lazyLoad Image--fadeIn"
                                            {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                                                data-src="{{ getImage($product->image, 'products/'.$product->product_code) }}"
                                                data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                                                alt='{{$product->product_name}}' data-image-id="{{$product->id}}" />

                                            <span class="Image__Loader"></span>

                                            <noscript>
                                                <img class="ProductItem__Image ProductItem__Image--alternate"
                                                    src="{{ getImage($product->image, 'products/'.$product->product_code) }}"
                                                    alt='{{$product->product_name}}' />

                                                @foreach ($product->images()->get() as $key => $image)
                                                {{-- BOX-A2_600x.jpg?v=1644800500 --}}
                                                    @if($product->image != $image->image_url)
                                                        <img class="ProductItem__Image"
                                                            src="{{ getImage($image->image_url, 'products/'.$product->product_code) }}"
                                                            alt='{{$product->product_name}}' />
                                                    @endif
                                                @endforeach
                                            </noscript>
                                        </div>
                                    </a>
                                    <div class="ProductItem__Info ProductItem__Info--center">
                                        <h2 class="ProductItem__Title Heading">
                                            <a href="{{ route('product-detail', [$product->id, str_replace(' ', '_', $product->product_name)]) }}">{{ $product->product_name }}</a>
                                        </h2>
                                        <div class="ProductItem__PriceList Heading">
                                            <span class="ProductItem__Price Price Text--subdued" data-money-convertible>
                                                    @if ($product->after_discount_price > 0 && $product->after_discount_price < $product->retail_price)
                                                        <span class="money">
                                                            RP.
                                                            <del>
                                                                {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                                            </del>
                                                            <span style="position:inherit; font-weight: 800;">
                                                                {{ rupiah_format(intval($product->after_discount_price ?? 0)) }}</span>
                                                        </span>
                                                    @else
                                                        <span class="money" >RP.
                                                            {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                                        </span>
                                                    @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div style="margin-top: 20px;padding: 10px; text-align: center;">
                    {{ $products->links('partials.layout.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(".Popover__Value").click(function() {
            $('.PageOverlay').removeClass('is-visible');
            $('html').removeClass('no-scroll');
            $('.PageOverlay').trigger("click");
        });

        $(".bc-sf-filter-block-content").click(function() {
            $('.close-filter').trigger("click");
            $('.PageOverlay').trigger("click");
        });
    </script>
@endpush

