@foreach ($banner as $key => $item)
<div class="Slideshow__Slide Carousel__Cell {{ $key == 0 ? 'is-selected' : '' }}" style="{{ $key == 0 ? 'visibility: visible;' : '' }}" data-slide-index="{{$key}}">
    {{-- Banner Mobile 1x1 = 800x800 --}}
    <div class="Slideshow__ImageContainer Image--contrast AspectRatio hidden-tablet-and-up"
            {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
        style="--aspect-ratio: 0.6521739130434783; background-image: url({{ getImage($item->banner_image, 'banner') }});">
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
    {{-- End Banner Mobile --}}
    {{-- Banner Web with data width --}}
    <div class="Slideshow__ImageContainer Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
            {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
        style="padding-bottom: 66.66666666666667%; --aspect-ratio: 1.5; background-image: url({{ getImage($item->banner_image, 'banner') }});">
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
    {{-- End Banner Web --}}
    <div class="Slideshow__Content Slideshow__Content--bottomCenter">
        <header class="SectionHeader">
            <div class="SectionHeader__ButtonWrapper">
                <div class="ButtonGroup ButtonGroup--spacingSmall">
                    {{-- url into banner url --}}
                    <a href="{{ $item->banner_url }}"class="ButtonGroup__Item Button">
                        SHOP NOW
                    </a>
                </div>
            </div>
        </header>
    </div>
</div>
@endforeach
