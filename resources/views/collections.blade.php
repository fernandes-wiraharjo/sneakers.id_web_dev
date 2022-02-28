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

                    @livewire('product-list')

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
