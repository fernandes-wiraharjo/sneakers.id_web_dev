<div>
    <div id="kt_carousel_1_carousel" class="carousel carousel-custom slide mt-10 mb-5" data-bs-ride="carousel" data-bs-interval="3000">
        <!--begin::Carousel-->
        <div class="carousel-inner">
            @foreach ($banner as $key => $item)
                @php
                    $image_size = getimagesize(getImage($item->banner_image, 'banner'));
                    $ratio = $image_size[0] / $image_size[1];
                @endphp
                <!--begin::Item-->
                <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
                    <img class="w-100 h-fit"
                        {{-- 1x1 Mobile_Banner_mocca_1x1.jpg?v=1644823129 --}}
                        src="{{ getImage($item->banner_image, 'banner') }}"
                        {{-- x800  Mobile_Banner_mocca_x800.jpg?v=1644823129--}}
                        data-src="{{ getImage($item->banner_image, 'banner') }}"
                        alt="" />
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Carousel-->
    </div>
</div>
