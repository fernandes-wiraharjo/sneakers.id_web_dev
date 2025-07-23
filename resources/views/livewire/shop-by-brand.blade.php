@foreach ($brand as $item)
@php
    $image_size = getimagesize(getImage($item->image, 'brand/'));
    // $ratio = $image_size[0] / $image_size[1];
@endphp
<div class="Carousel__Cell">
    <div class="ProductItem">
        <div class="ProductItem__Wrapper">
            {{-- Item detail route --}}
            <a href="{{ route('collections', 'all.' . $item->brand_code) }}" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                    <div class="AspectRatio AspectRatio--withFallback" style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: 1;">
                        {{-- multi image --}}
                        <img class="ProductItem__Image Image--lazyLoad Image--fadeIn"
                        {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                            data-src="{{ getImage($item->brand_image, 'brand') }}"
                            data-widths="[1200]" data-sizes="auto"
                            alt='{{ $item->brand_title }}' data-image-id="{{$item->id}}" />

                        <img class="ProductItem__Image ProductItem__Image--alternate Image--lazyLoad Image--fadeIn"
                            {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                                data-src="{{ getImage($item->brand_image, 'brand') }}"
                                data-widths="[1200]" data-sizes="auto"
                                alt='{{ $item->brand_title }}' data-image-id="{{$item->id}}" />

                        <span class="Image__Loader"></span>
                    </div>
            </a>
            {{-- <div class="ProductItem__Info ProductItem__Info--center"> --}}
                {{-- Brand --}}
                {{-- <p class="ProductItem__Vendor Heading">{{ $item->brand_title }}</p> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endforeach
