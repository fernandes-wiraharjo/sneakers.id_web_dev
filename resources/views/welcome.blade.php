<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.layout.header')

<body class="prestige--v4 template-collection">
    @include('partials.layout.navbar')
    <main id="main" role="main">
        <div id="shopify-section-slideshow" class="shopify-section shopify-section--slideshow">
            <section id="section-slideshow" data-section-id="slideshow" data-section-type="slideshow">
                <div class="Slideshow">
                    @livewire('banner-image')
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
                            <a href="/collections/new-release" class="Button Button--primary">SEE MORE</a>
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
                            <a href="/collections/best-seller" class="Button Button--primary">SEE MORE</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <div class="bc-sf-search-suggestion-wrapper " style="top: 207.504px; left: 91px; width: 1247px;">
        <div class="bc-sf-search-suggestion-popover" data-direction="left"
            style="top: -20px; left: 20px; display: none;"></div>
        <ul id="ui-id-1" tabindex="0"
            class="ui-menu ui-widget ui-widget-content ui-autocomplete bc-sf-search-suggestion ui-front"
            style="display: none; width: 1247px; top: 0px; left: 0px;" data-search-box="#bc-sf-search-box-0">
            <li class="bc-sf-search-suggestion-group ui-menu-divider ui-widget-content" data-group="suggestions"
                aria-label="Suggestions">
                <ul aria-hidden="true" aria-expanded="false" class="ui-menu ui-widget ui-widget-content ui-front"
                    style="display: none;"></ul>
            </li>

        </ul>
    </div>

    @include('partials.layout.footer', ['footer' => $footer])

    @include('partials.layout.script')
</body>

</html>
