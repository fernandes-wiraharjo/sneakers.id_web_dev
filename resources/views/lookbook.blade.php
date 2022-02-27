<html class="no-js" lang="en">

    <!--GEM_HEADER-->
    <link data-instant-track rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" class="gf-style" />
    <link data-instant-track rel="stylesheet" type="text/css" href="https://d1um8515vdn9kb.cloudfront.net/files/vendor.css?refresh=1" class="gf-style" />
    <link data-instant-track rel="stylesheet" type="text/css" href="//cdn.shopify.com/s/files/1/2854/1776/t/46/assets/gem-page-46791196787.css?v=8962339633992568205" class="gf_page_style" />
    <link data-instant-track class="gf_fonts" data-fonts="futura" href="//fonts.googleapis.com/css?family=futura" rel="stylesheet" type="text/css" />
    <link data-instant-track rel="stylesheet" type="text/css" href="https://d1um8515vdn9kb.cloudfront.net/libs/css/gfaccordion.css" class="gf_libs" />
    <link data-instant-track rel="stylesheet" type="text/css" href="https://d1um8515vdn9kb.cloudfront.net/libs/css/gfv3restabs.css" class="gf_libs" />
    <!--GEM_HEADER_END-->
    @include('partials.layout.header')
    <body class="prestige--v4 template-collection">
        @include('partials.layout.navbar')

        <main id="main" role="main">
            <div id="shopify-section-collection-template" class="shopify-section shopify-section--bordered">
                <section
                    data-section-id="collection-template"
                    data-section-type="collection"
                    data-section-settings='{
                      "collectionUrl": "\/collections\/staycool-women",
                      "currentTags": [],
                      "sortBy": "created-descending",
                      "filterPosition": "sidebar"
                    }'
                >
                    <video src="{{ asset('video/video.webm') }}" autoplay muted loop playinline style="width: 100%;"></video>
                    <div id="collection-filter-drawer" class="CollectionFilters Drawer Drawer--secondary Drawer--fromRight" aria-hidden="true"></div>
                </section>
            </div>

            @if ($lookbook)
                <!--Gem_Page_Main_Editor-->
            <div class="clearfix"></div>
            <div class="gryffeditor">
                <div data-label="Separator" id="e-1581391450735" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391450735" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>

                <div data-label="Separator" id="e-1581392557358" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581392557358" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
                <div data-label="Heading" id="e-1581391207492" class="element-wrap" data-icon="gpicon-heading" data-ver="1" data-id="1581391207492" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        <h5>
                            {{ $lookbook->look_book_title }}<br />
                        </h5>
                    </div>
                </div>
                <div data-label="Accordion" id="m-1573634938331" class="module-wrap" data-icon="gpicon-accordion" data-ver="1" data-id="1573634938331" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        {!! $lookbook->look_book_content !!}
                    </div>
                </div>
                <div data-label="Separator" id="e-1581391443455" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391443455" style="">
                    <div class="elm gf-elm-center gf-elm-center-lg gf-elm-center-md gf-elm-center-sm gf-elm-center-xs" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
            </div>
            <div id="divContentBk"></div>

            <div id="shopify-section-slideshow" class="shopify-section shopify-section--slideshow">
                <section id="section-slideshow" data-section-id="slideshow" data-section-type="slideshow">
                    <div class="Slideshow">
                        <div
                            class="Slideshow__Carousel Carousel Carousel--fadeIn Carousel--insideDots"
                            data-flickity-config='{
                              "prevNextButtons": true,
                              "setGallerySize": true,
                              "adaptiveHeight": true,
                              "wrapAround": true,
                              "dragThreshold": 15,
                              "pauseAutoPlayOnHover": false,
                              "autoPlay": 6000,
                              "pageDots": false
                            }'
                        >
                            <div id="Slide55579676-a943-4cd9-84fa-d66661f7e630" class="Slideshow__Slide Carousel__Cell is-selected" style="visibility: visible;" data-slide-index="0">
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
                                    style="
                                        --aspect-ratio: 0.6521739130434783;
                                        background-image: url(https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max);
                                    "
                                >
                                    <img
                                        class="Slideshow__Image Image--lazyLoad"
                                        src="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max"
                                        data-src="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                                    style="
                                        padding-bottom: 66.66666666666667%;
                                        --aspect-ratio: 1.5;
                                        background-size: cover;
                                        background-image: url(https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max;);
                                    "
                                    ;
                                ></div>
                                <div class="Slideshow__Content Slideshow__Content--bottomCenter">
                                    <header class="SectionHeader">
                                        <div class="SectionHeader__ButtonWrapper">
                                            <div class="ButtonGroup ButtonGroup--spacingSmall"><a href="/pages/stcl-x-mocca" class="ButtonGroup__Item Button">SOCKS NOW</a></div>
                                        </div>
                                    </header>
                                </div>
                            </div>

                            <div id="Slide55579676-a943-4cd9-84fa-d66661f7e630" class="Slideshow__Slide Carousel__Cell" style="visibility: visible;" data-slide-index="0">
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
                                    style="--aspect-ratio: 0.6521739130434783; background-image: url(https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK);"
                                >
                                    <img
                                        class="Slideshow__Image Image--lazyLoad"
                                        src="https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK"
                                        data-src="https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                                    style="
                                        padding-bottom: 66.66666666666667%;
                                        --aspect-ratio: 1.5;
                                        background-size: cover;
                                        background-image: url(https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK;);
                                    "
                                    ;
                                ></div>
                                <div class="Slideshow__Content Slideshow__Content--bottomCenter">
                                    <header class="SectionHeader">
                                        <div class="SectionHeader__ButtonWrapper">
                                            <div class="ButtonGroup ButtonGroup--spacingSmall"><a href="/pages/stcl-x-mocca" class="ButtonGroup__Item Button">SOCKS NOW</a></div>
                                        </div>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span id="section-slideshow-end" class="Anchor"></span>
                </section>
            </div>

            <div class="gryffeditor">
                <div data-label="Separator" id="e-1581391450735" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391450735" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>

                <div data-label="Separator" id="e-1581392557358" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581392557358" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
                <div data-label="Heading" id="e-1581391207492" class="element-wrap" data-icon="gpicon-heading" data-ver="1" data-id="1581391207492" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        <h5>"{!! $lookbook->description !!}".</h5>
                    </div>
                </div>
                <div data-label="Separator" id="e-1581391443455" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391443455" style="">
                    <div class="elm gf-elm-center gf-elm-center-lg gf-elm-center-md gf-elm-center-sm gf-elm-center-xs" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
                <div>
                    @if ($next_page)
                        <a href="{{ route('lookbook', $next_page) }}" class="Form__Submit Button Button--primary">Next Page</a>
                    @endif

                    @if ($prev_page)
                        <a href="{{ route('lookbook', $prev_page) }}" class="Form__Submit Button Button--primary">Previous Page</a>
                    @endif
                </div>
            </div>
            @else
            <!--Gem_Page_Main_Editor-->
            <div class="clearfix"></div>
            <div class="gryffeditor">
                <div data-label="Separator" id="e-1581391450735" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391450735" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>

                <div data-label="Separator" id="e-1581392557358" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581392557358" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
                <div data-label="Heading" id="e-1581391207492" class="element-wrap" data-icon="gpicon-heading" data-ver="1" data-id="1581391207492" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        <h5>
                            Inspired by the blurred edges between sport and life as we strive together towards a new and better normal, our season fuses technical fabrics with elevated silhouettes in calming, low-contrast colours.<br />
                        </h5>
                    </div>
                </div>
                <div data-label="Accordion" id="m-1573634938331" class="module-wrap" data-icon="gpicon-accordion" data-ver="1" data-id="1573634938331" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        <h5>Photography: Paola Kudacki<br>Styling: Anna Trevelyan</h5>
                    </div>
                </div>
                <div data-label="Separator" id="e-1581391443455" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391443455" style="">
                    <div class="elm gf-elm-center gf-elm-center-lg gf-elm-center-md gf-elm-center-sm gf-elm-center-xs" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
            </div>
            <div id="divContentBk"></div>

            <div id="shopify-section-slideshow" class="shopify-section shopify-section--slideshow">
                <section id="section-slideshow" data-section-id="slideshow" data-section-type="slideshow">
                    <div class="Slideshow">
                        <div
                            class="Slideshow__Carousel Carousel Carousel--fadeIn Carousel--insideDots"
                            data-flickity-config='{
                              "prevNextButtons": true,
                              "setGallerySize": true,
                              "adaptiveHeight": true,
                              "wrapAround": true,
                              "dragThreshold": 15,
                              "pauseAutoPlayOnHover": false,
                              "autoPlay": 6000,
                              "pageDots": false
                            }'
                        >
                            <div id="Slide55579676-a943-4cd9-84fa-d66661f7e630" class="Slideshow__Slide Carousel__Cell is-selected" style="visibility: visible;" data-slide-index="0">
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
                                    style="
                                        --aspect-ratio: 0.6521739130434783;
                                        background-image: url(https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max);
                                    "
                                >
                                    <img
                                        class="Slideshow__Image Image--lazyLoad"
                                        src="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max"
                                        data-src="https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                                    style="
                                        padding-bottom: 66.66666666666667%;
                                        --aspect-ratio: 1.5;
                                        background-size: cover;
                                        background-image: url(https://image-cdn.hypb.st/https%3A%2F%2Fhypebeast.com%2Fimage%2F2018%2F03%2Fhaven-stone-island-nike-spring-summer-2018-lookbook-0.jpg?w=960&cbr=1&q=90&fit=max;);
                                    "
                                    ;
                                ></div>
                                <div class="Slideshow__Content Slideshow__Content--bottomCenter">
                                    <header class="SectionHeader">
                                        <div class="SectionHeader__ButtonWrapper">
                                            <div class="ButtonGroup ButtonGroup--spacingSmall"><a href="/pages/stcl-x-mocca" class="ButtonGroup__Item Button">SOCKS NOW</a></div>
                                        </div>
                                    </header>
                                </div>
                            </div>

                            <div id="Slide55579676-a943-4cd9-84fa-d66661f7e630" class="Slideshow__Slide Carousel__Cell" style="visibility: visible;" data-slide-index="0">
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
                                    style="--aspect-ratio: 0.6521739130434783; background-image: url(https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK);"
                                >
                                    <img
                                        class="Slideshow__Image Image--lazyLoad"
                                        src="https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK"
                                        data-src="https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK"
                                        alt=""
                                    />
                                </div>
                                <div
                                    class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                                    style="
                                        padding-bottom: 66.66666666666667%;
                                        --aspect-ratio: 1.5;
                                        background-size: cover;
                                        background-image: url(https://www.lebook.com/sites/default/files/styles/showcase_image_large/public/s19_seasonal_carlos_aj12-2_0343_hfr2.jpg?itok=elA196lK;);
                                    "
                                    ;
                                ></div>
                                <div class="Slideshow__Content Slideshow__Content--bottomCenter">
                                    <header class="SectionHeader">
                                        <div class="SectionHeader__ButtonWrapper">
                                            <div class="ButtonGroup ButtonGroup--spacingSmall"><a href="/pages/stcl-x-mocca" class="ButtonGroup__Item Button">SOCKS NOW</a></div>
                                        </div>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span id="section-slideshow-end" class="Anchor"></span>
                </section>
            </div>

            <div class="gryffeditor">
                <div data-label="Separator" id="e-1581391450735" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391450735" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>

                <div data-label="Separator" id="e-1581392557358" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581392557358" style="">
                    <div class="elm gf-elm-center gf-elm-center-md gf-elm-center-sm gf-elm-center-xs gf-elm-center-lg" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
                <div data-label="Heading" id="e-1581391207492" class="element-wrap" data-icon="gpicon-heading" data-ver="1" data-id="1581391207492" style="">
                    <div class="elm text-edit gf-elm-center gf-elm-center-md gf-elm-left-lg gf-elm-left-sm gf-elm-justify-xs" data-gemlang="en" data-exc="">
                        <h5>"There's something to say about challenges and how they shape our choices. We become conscious of what truly matters—the deepest sense of instinct".</h5>
                    </div>
                </div>
                <div data-label="Separator" id="e-1581391443455" class="element-wrap" data-icon="gpicon-separator" data-ver="1" data-id="1581391443455" style="">
                    <div class="elm gf-elm-center gf-elm-center-lg gf-elm-center-md gf-elm-center-sm gf-elm-center-xs" data-align="left" data-exc=""><hr class="gf_separator" /></div>
                </div>
            </div>
            @endif
        </main>

        @include('partials.layout.footer')

        @include('partials.layout.script')
    </body>
</html>
