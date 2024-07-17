<div>
    <div class="Slideshow__Carousel Carousel Carousel--insideDots"
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
        <div class="Slideshow__Image Container Image--contrast hidden-tablet-and-up"
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
            >
            <img fetchpriority="high" class="Slideshow__Image "
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
                src="{{ getImage($item->banner_image, 'banner') }}"
                alt="" />
        </div>
    </a>
    {{-- End Banner Mobile --}}
    {{-- Banner Web with data width --}}
    <a href="{{ $item->banner_url }}">
        <div class="Slideshow__Image Container Image--contrast AspectRatio AspectRatio--withFallback hidden-phone"
                {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
            style="padding-bottom: 66.66666666666667%; --aspect-ratio: {{round($ratio,2)}}; background-image: url({{ getImage($item->banner_image, 'banner') }}); background-repeat: no-repeat; background-size: cover;">
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
</div>
