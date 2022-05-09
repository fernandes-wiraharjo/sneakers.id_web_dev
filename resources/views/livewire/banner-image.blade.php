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
@foreach ($banner as $key => $item)
@php
    $image_size = getimagesize(getImage($item->banner_image, 'banner'));
    $ratio = $image_size[0] / $image_size[1];
@endphp
<div class="Slideshow__Slide Carousel__Cell {{ $key == 0 ? 'is-selected' : '' }}" style="{{ $key == 0 ? 'visibility: visible;' : '' }}" data-slide-index="{{$key}}">
    {{-- Banner Mobile 1x1 = 800x800 --}}
    <a href="{{ $item->banner_url }}">
        <div class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
            style="--aspect-ratio: {{round($ratio,2)}}; background-image: url({{ getImage($item->banner_image, 'banner') }});">
            <img class="Slideshow__Image Image--lazyLoad" style="max-width: 100% !important; height: auto !important;"
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
                src="{{ getImage($item->banner_image, 'banner') }}"
                {{-- x800  Mobile_Banner_mocca_x800.jpg?v=1644823129--}}
                data-src="{{ getImage($item->banner_image, 'banner') }}"
                alt="" />

            <noscript>
                <img class="Slideshow__Image"
                {{-- x800  Mobile_Banner_mocca_x800.jpg?v=1644823129--}}
                src="{{ getImage($item->banner_image, 'banner') }}"
                alt="" />
            </noscript>
        </div>
    </a>
    {{-- End Banner Mobile --}}
    {{-- Banner Web with data width --}}
    <a href="{{ $item->banner_url }}">
        <div class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
            style="padding-bottom: 66.66666666666667%; --aspect-ratio: {{round($ratio,2)}}; background-image: url({{ getImage($item->banner_image, 'banner') }});">

            <img class="Slideshow__Image Image--lazyLoad hide-no-js" style="max-width: 100% !important; height: auto !important;"
                {{-- WEB_Banner_mocca_{width}x.jpg --}}
                data-src="{{ getImage($item->banner_image, 'banner') }}"
                data-optimumx="1.2"
                data-widths="[400, 600, 800, 1000, 1200, 1400, 1600, 1800, 2000, 2200]"
                data-sizes="auto" alt="" />
            <noscript>
                <img class="Slideshow__Image"
                {{-- WEB_Banner_mocca_{width}x.jpg --}}
                src="{{ getImage($item->banner_image, 'banner') }}s"
                alt="" />
            </noscript>
        </div>
    </a>
    {{-- End Banner Web --}}
    {{-- <div class="Slideshow__Content Slideshow__Content--bottomCenter">
        <header class="SectionHeader">
            <div class="SectionHeader__ButtonWrapper">
                <div class="ButtonGroup ButtonGroup--spacingSmall">
                    <a href="{{ $item->banner_url }}"class="ButtonGroup__Item Button">
                        SHOP NOW
                    </a>
                </div>
            </div>
        </header>
    </div> --}}
</div>
@endforeach
</div>
