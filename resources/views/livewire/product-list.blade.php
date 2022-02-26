<div class="CollectionMain" style="padding-top: 10rem; padding-botom: 5rem; margin-bottom: 5rem;">
    <div class="CollectionToolbar CollectionToolbar--top CollectionToolbar--reverse">
        <div class="CollectionToolbar__Group">
            <button
                class="CollectionToolbar__Item CollectionToolbar__Item--filter Heading Text--subdued u-h6 hidden-lap-and-up"
                data-action="open-drawer" data-drawer-id="collection-filter-drawer" aria-label="Show filters">
                Filter
            </button>
            <button class="CollectionToolbar__Item CollectionToolbar__Item--sort Heading Text--subdued u-h6"
                aria-label="Show sort by" aria-haspopup="true" aria-expanded="false"
                aria-controls="collection-sort-popover">
                Sort
                <svg class="Icon Icon--select-arrow" role="presentation" viewBox="0 0 19 12">
                    <polyline fill="none" stroke="currentColor" points="17 2 9.5 10 2 2" fill-rule="evenodd"
                        stroke-width="2" stroke-linecap="square"></polyline>
                </svg>
            </button>
        </div>
        <div id="collection-sort-popover" class="Popover Popover--positionBottom Popover--alignRight" aria-hidden="true" tabindex="-1" style="top: 233px; right: 0px;">
            <header class="Popover__Header">
                <button class="Popover__Close Icon-Wrapper--clickable" data-action="close-popover"><svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
                    <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                    </svg>
                </button>
                <span class="Popover__Title Heading u-h4">Sort</span>
            </header>
            <div class="Popover__Content">
                <div class="Popover__ValueList" data-scrollable="false">
                    <button class="Popover__Value is-selected Heading Link Link--primary u-h6" data-value="manual" data-action="select-value">
                    Featured
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="best-selling" data-action="select-value">
                    Best selling
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="title-ascending" data-action="select-value">
                    Alphabetically, A-Z
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="title-descending" data-action="select-value">
                    Alphabetically, Z-A
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="price-ascending" data-action="select-value">
                    Price, low to high
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="price-descending" data-action="select-value">
                    Price, high to low
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="created-ascending" data-action="select-value">
                    Date, old to new
                    </button><button class="Popover__Value  Heading Link Link--primary u-h6" data-value="created-descending" data-action="select-value">
                    Date, new to old
                    </button>
                </div>
            </div>
        </div>
        <div class="Search__SearchBar" style="margin-left: 20px; width: 90%;">
            <div class="Search__InputIconWrapper">
                <span class="hidden-tablet-and-up"><svg class="Icon Icon--search" role="presentation"
                        viewBox="0 0 18 17">
                        <g transform="translate(1 1)" stroke="currentColor" fill="none" fill-rule="evenodd"
                            stroke-linecap="square">
                            <path d="M16 16l-5.0752-5.0752"></path>
                            <circle cx="6.4" cy="6.4" r="6.4"></circle>
                        </g>
                    </svg></span>
                <span class="hidden-phone"><svg class="Icon Icon--search-desktop" role="presentation"
                        viewBox="0 0 21 21">
                        <g transform="translate(1 1)" stroke="currentColor" stroke-width="2" fill="none"
                            fill-rule="evenodd" stroke-linecap="square">
                            <path d="M18 18l-5.7096-5.7096"></path>
                            <circle cx="7.2" cy="7.2" r="7.2"></circle>
                        </g>
                    </svg></span>
            </div>

            <input wire:model="search" type="text" class="Search__Input Heading ui-autocomplete-input bc-sf-search-box"
                name="q" autocomplete="off" autocorrect="off" autocapitalize="off" placeholder="Search..."
                autofocus="">
        </div>
    </div>
    <div class="CollectionInner">
        <div class="CollectionInner__Sidebar CollectionInner__Sidebar--withTopToolbar hidden-pocket"
            style="top: -4.0625px;">
            @include('components.filters')
        </div>
        <div class="CollectionInner__Products">
            <div class="ProductListWrapper">
                <div id="bc-sf-filter-product" data-bc-sort="manual"
                    class="ProductList ProductList--grid ProductList--removeMargin Grid" data-mobile-count="2"
                    data-desktop-count="4">
                    @foreach ($products as $product)
                        <div class="Grid__Cell 1/2--phone 1/3--tablet-and-up 1/4--desk SOCKS">
                            <div class="ProductItem">
                                <div class="ProductItem__Wrapper">
                                    <a href="{{ route('product-detail', $product->id) }}"
                                        class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                        <div class="AspectRatio AspectRatio--withFallback"
                                            style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: 1;">
                                            {{-- multi image --}}
                                            @foreach ($product->images()->get() as $key => $image)
                                                <img class="ProductItem__Image {{ $key == 0 ? 'ProductItem__Image--alternate' : '' }} Image--lazyLoad Image--fadeIn"
                                                    {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                                                    data-src="{{ getImage($image->image_url, 'products') }}"
                                                    data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                                                    alt='{{ $product->product_name }}'
                                                    data-image-id="{{ $image->id }}" />
                                            @endforeach

                                            <span class="Image__Loader"></span>

                                            <noscript>
                                                @foreach ($product->images()->get() as $key => $image)
                                                    {{-- BOX-A2_600x.jpg?v=1644800500 --}}
                                                    <img class="ProductItem__Image {{ $key == 0 ? 'ProductItem__Image--alternate' : '' }}"
                                                        src="{{ getImage($image->image_url, 'products') }}"
                                                        alt='{{ $product->product_name }}' />
                                                @endforeach
                                            </noscript>
                                        </div>
                                    </a>
                                    <div class="ProductItem__Info ProductItem__Info--center">
                                        <h2 class="ProductItem__Title Heading">
                                            <a href="{{ $product->product_link }}">{{ $product->product_name }}</a>
                                        </h2>
                                        <div class="ProductItem__PriceList Heading">
                                            <span class="ProductItem__Price Price Text--subdued"
                                                data-money-convertible><span class="money">RP.
                                                    {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}</span></span>
                                        </div>
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
