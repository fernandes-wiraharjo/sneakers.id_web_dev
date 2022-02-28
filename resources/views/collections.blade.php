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

                    @livewire('product-list', ['keyword' => $keyword])

                </section>
            </div>
        </main>

        @include('partials.layout.footer')

        @include('partials.layout.script')
    </body>
</html>
