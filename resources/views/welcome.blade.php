<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.layout.header')

<body class="prestige--v4 template-collection">
    @include('partials.layout.navbar')
    <main id="main" role="main">
        <div id="shopify-section-slideshow" class="shopify-section shopify-section--slideshow">
            <section id="section-slideshow" data-section-id="slideshow" data-section-type="slideshow">
                <div class="Slideshow">
                    <div class="Slideshow__Carousel Carousel Carousel--fadeIn Carousel--insideDots"
                        data-flickity-config='{
                            "prevNextButtons": false,
                            "setGallerySize": true,
                            "adaptiveHeight": true,
                            "wrapAround": true,
                            "dragThreshold": 15,
                            "pauseAutoPlayOnHover": false,
                            "autoPlay": 6000,
                            "pageDots": true
                          }'>
                        @livewire('banner-image')
                    </div>
                </div>

                <span id="section-slideshow-end" class="Anchor"></span>
            </section>
        </div>
        <div id="shopify-section-1574100639126" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="1574100639126"
                data-section-type="featured-collections" data-settings='{
  "layout": "carousel"
}'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">NEW RELEASES</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-1574100639126-0" aria-hidden="false" role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
    "prevNextButtons": true,
    "pageDots": false,
    "wrapAround": false,
    "contain": true,
    "cellAlign": "center",
    "watchCSS": true,
    "dragThreshold": 8,
    "groupCells": true,
    "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
  }'>
                            @livewire('new-release-item')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/newarrivals" class="Button Button--primary">SEE MORE</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="shopify-section-1576229093919" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="1576229093919"
                data-section-type="featured-collections" data-settings='{
                      "layout": "carousel"
                    }'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">BEST SELLERS</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-1576229093919-0" aria-hidden="false" role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
                                "prevNextButtons": true,
                                "pageDots": false,
                                "wrapAround": false,
                                "contain": true,
                                "cellAlign": "center",
                                "watchCSS": true,
                                "dragThreshold": 8,
                                "groupCells": true,
                                "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                              }'>
                            @livewire('best-sellers')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/best-sellers" class="Button Button--primary">SEE MORE</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="shopify-section-1596077408308" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="1596077408308"
                data-section-type="featured-collections" data-settings='{
                      "layout": "carousel"
                    }'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">STAYCOOL MASK</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-1596077408308-0" aria-hidden="false" role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
                                "prevNextButtons": true,
                                "pageDots": false,
                                "wrapAround": false,
                                "contain": true,
                                "cellAlign": "center",
                                "watchCSS": true,
                                "dragThreshold": 8,
                                "groupCells": true,
                                "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                              }'>
                            @livewire('new-release-item')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/cool-masks" class="Button Button--primary">SEE MORE</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div id="shopify-section-16190810405a16dff1" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="16190810405a16dff1"
                data-section-type="featured-collections" data-settings='{
  "layout": "carousel"
}'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">COOL STRAP</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-16190810408c513cb5-0" aria-hidden="false" role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
    "prevNextButtons": true,
    "pageDots": false,
    "wrapAround": false,
    "contain": true,
    "cellAlign": "center",
    "watchCSS": true,
    "dragThreshold": 8,
    "groupCells": true,
    "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
  }'>
                            @livewire('new-release-item')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/cool-strap" class="Button Button--primary">View all products</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="shopify-section-1611145506e0a75173" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="1611145506e0a75173"
                data-section-type="featured-collections" data-settings='{
                      "layout": "carousel"
                    }'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">COOL SLEEVE</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-1611145506e0a75173-0" aria-hidden="false" role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
                                "prevNextButtons": true,
                                "pageDots": false,
                                "wrapAround": false,
                                "contain": true,
                                "cellAlign": "center",
                                "watchCSS": true,
                                "dragThreshold": 8,
                                "groupCells": true,
                                "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
                              }'>
                            @livewire('new-release-item')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/cool-sleeve" class="Button Button--primary">View all products</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="shopify-section-1624693343780f8edd" class="shopify-section shopify-section--bordered">
            <section class="Section Section--spacingNormal" data-section-id="1624693343780f8edd"
                data-section-type="featured-collections" data-settings='{
  "layout": "carousel"
}'>
                <header class="SectionHeader SectionHeader--center">
                    <div class="Container">
                        <h2 class="SectionHeader__Heading Heading u-h1">STAYCOOL SET</h2>
                    </div>
                </header>
                <div class="TabPanel" id="block-77f0e73f-6103-4f26-bb6d-d5d948ec8f72" aria-hidden="false"
                    role="tabpanel">
                    <div class="ProductListWrapper">
                        <div class="ProductList ProductList--carousel Carousel" data-flickity-config='{
    "prevNextButtons": true,
    "pageDots": false,
    "wrapAround": false,
    "contain": true,
    "cellAlign": "center",
    "watchCSS": true,
    "dragThreshold": 8,
    "groupCells": true,
    "arrowShape": {"x0": 20, "x1": 60, "y1": 40, "x2": 60, "y2": 35, "x3": 25}
  }'>
                            @livewire('new-release-item')
                        </div>
                    </div>
                    <div class="Container">
                        <div class="SectionFooter">
                            <a href="/collections/staycool-set" class="Button Button--primary">View all products</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END content_for_index -->
    </main>
    @include('partials.layout.footer', ['footer' => $footer])

    @include('partials.layout.script')
</body>

</html>