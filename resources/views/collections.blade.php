<html class="no-js" lang="en">
@include('partials.layout.header') 
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar') 

        <main id="main" role="main">
            <div id="shopify-section-collection-template" class="shopify-section shopify-section--bordered">
                <section
                    data-section-id="collection-template"
                    data-section-type="collection"
                    data-section-settings='{
                      "collectionUrl": "\/collections\/all-products",
                      "currentTags": [],
                      "sortBy": "manual",
                      "filterPosition": "sidebar"
                    }'
                >
                    <header class="PageHeader">
                        <div class="Container">
                            <div class="SectionHeader SectionHeader--center"></div>
                        </div>
                    </header>
                    
                    
                    <div class="CollectionMain" style="padding-top: 10rem; padding-botom: 5rem; margin-bottom: 5rem;">
                            <div class="CollectionInner__Products">
                                <div class="ProductListWrapper">
                                    <div id="bc-sf-filter-product" data-bc-sort="manual" class="ProductList ProductList--grid ProductList--removeMargin Grid" data-mobile-count="2" data-desktop-count="6">
                                        <div class="Grid__Cell 1/2--phone 1/4--tablet-and-up 1/6--desk SOCKS">
                                            <div class="ProductItem">
                                                <div class="ProductItem__Wrapper">
                                                    <a href="/collections/all-products/products/back-to-black" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                                                        <div class="AspectRatio AspectRatio--withFallback" style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: 1;">
                                                            <img
                                                                class="ProductItem__Image ProductItem__Image--alternate Image--lazyLoad Image--fadeIn"
                                                                data-src="//cdn.shopify.com/s/files/1/2854/1776/products/BLACKTRIX-A1_700x_a5e98c1c-d743-4290-a9d1-cd3e2f521b66_{width}x.jpg?v=1643614906"
                                                                data-widths="[200,300,400,600]"
                                                                data-sizes="auto"
                                                                alt="BACK TO BLACK"
                                                                data-image-id="29193753722995"
                                                            />
                                                            <img
                                                                class="ProductItem__Image Image--lazyLoad Image--fadeIn"
                                                                data-src="//cdn.shopify.com/s/files/1/2854/1776/products/backtoblack_{width}x.jpg?v=1643614906"
                                                                data-widths="[200,400,600,700,800,900,1000,1200]"
                                                                data-sizes="auto"
                                                                alt="BACK TO BLACK"
                                                                data-image-id="29193753755763"
                                                            />
                                                            <span class="Image__Loader"></span>

                                                            <noscript>
                                                                <img
                                                                    class="ProductItem__Image ProductItem__Image--alternate"
                                                                    src="//cdn.shopify.com/s/files/1/2854/1776/products/BLACKTRIX-A1_700x_a5e98c1c-d743-4290-a9d1-cd3e2f521b66_600x.jpg?v=1643614906"
                                                                    alt="BACK TO BLACK"
                                                                />
                                                                <img class="ProductItem__Image" src="//cdn.shopify.com/s/files/1/2854/1776/products/backtoblack_600x.jpg?v=1643614906" alt="BACK TO BLACK" />
                                                            </noscript>
                                                        </div>
                                                    </a>
                                                    <div class="ProductItem__Info ProductItem__Info--center">
                                                        <h2 class="ProductItem__Title Heading">
                                                            <a href="/collections/all-products/products/back-to-black">BACK TO BLACK</a>
                                                        </h2>
                                                        <div class="ProductItem__PriceList Heading">
                                                            <span class="ProductItem__Price Price Text--subdued" data-money-convertible><span class="money">Rp 299.000</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div id="bc-sf-filter-bottom-pagination"></div> --}}
                                {{-- <div id="bc-sf-filter-load-more"></div> --}}
                            </div>
                        </div>
                    </div>
                </section>
               
            </div>
            {{-- <div id="shopify-section-recently-viewed-products" class="shopify-section shopify-section--bordered shopify-section--hidden">
                <section
                    class="Section Section--spacingNormal"
                    data-section-id="recently-viewed-products"
                    data-section-type="recently-viewed-products"
                    data-section-settings='{"productId": null}'
                >
                    <header class="SectionHeader SectionHeader--center">
                        <div class="Container">
                            <h3 class="SectionHeader__Heading Heading u-h3">Recently viewed</h3>
                        </div>
                    </header>
                </section>
            </div>
            <div id="shopify-section-collection-footer" class="shopify-section"></div> --}}
        </main>

        @include('partials.layout.footer') 

        @include('partials.layout.script') 
    </body>
</html>
