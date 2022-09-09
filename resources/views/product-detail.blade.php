@push('styles')
<style>
    .u-h6 {
        font-size: 13px;
    }
</style>
@endpush
<x-base-front-layout>
    <div class="mt-20 px-10">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column flex-row-auto col-8 min-h-full">
                <div class="d-flex flex-column-auto h-2/3">
                    <!--begin::Slider-->
                    <div class="tns tns-default mb-10">
                        <!--begin::Wrapper-->
                        <div id="image-initiator" data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev" data-tns-next-button="#kt_team_slider_next" data-tns-responsive="{1200: {items: 1}, 992: {items: 1}}">
                            @foreach ($product->images as $key => $item)
                                @if ($product->image != $item->image_url)
                                    <!--begin::Item-->
                                    <div class="text-center">
                                        <!--begin::Photo-->
                                        <div class="mx-auto mb-5 d-flex min-h-600px min-w-600px bgi-no-repeat bgi-size-contain bgi-position-center image-catalog-preview" data-id="{{ $key }}" style="background-image:url('{{ getImage($item->image_url, 'products/' . $product->product_code) }}')">
                                        </div>
                                        <!--end::Photo-->
                                    </div>
                                    <!--end::Item-->
                                @endif
                            @endforeach
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Button-->
                        <button class="btn btn-icon btn-light bg-transparent" id="kt_team_slider_prev">
                           <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                            <span class="svg-icon svg-icon-3x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button class="btn btn-icon btn-light bg-transparent" id="kt_team_slider_next">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-3x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Slider-->
                </div>

                <div class="d-flex flex-column-fluid flex-center">
                    @foreach ($product->images as $key => $item)
                        @if ($product->image != $item->image_url)
                            <!--begin::Col-->
                            <div class="col px-2 py-5">
                                <!--begin::Overlay-->
                                <a class="d-block overlay"
                                    href="#" onclick="change('{{ $key }}')">
                                    <!--begin::Image-->
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover min-h-75px min-w-75px card-rounded"
                                        style="background-image:url('{{ getImage($item->image_url, 'products/' . $product->product_code) }}')">
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Action-->
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 image-catalog-{{$key}}" data-id="{{ $key }}"
                                        {{-- onclick="change('{{ $key }}')" --}}
                                        >
                                        <i class="bi bi-eye-fill fs-2x text-white"></i>
                                    </div>
                                    <!--end::Action-->
                                </a>
                            </div>
                            <!--end::Col-->
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid flex-center">
                <div class="d-flex flex-column">
                    <div class="Container">
                        <div class="ProductMeta">
                            <div class="ProductMeta__PriceList Heading">{{ $product->product_code }}</div>
                            <h2 class="ProductMeta__Vendor Heading u-h6">
                                {{ $product->detail->brand->brand_title }}</h2>
                            <h1 class="ProductMeta__Title Heading u-h2">{{ $product->product_name }}</h1>
                            <div class="ProductMeta__PriceList Heading">
                                <span class="ProductMeta__Price Price Text--subdued u-h4"
                                    data-money-convertible>
                                    @if ($product->detail->discount_percentage > 0)
                                        <span class="money">
                                            RP.
                                            <del class="fs-5">
                                                {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                            </del>
                                            <span style="position:inherit; font-weight: 800;">
                                                {{ rupiah_format(intval($product->detail->after_discount_price ?? 0)) }}
                                            </span>
                                        </span>
                                        <div style="color: red; font-size: 20px; font-weight: bold;">
                                            {{ $product->detail->discount_percentage }}% OFF
                                        </div>
                                    @else
                                        <span class="money">RP.
                                            {{ rupiah_format(intval($product->detail->retail_price ?? 0)) }}
                                        </span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div style="margin: 50px;"></div>
                        <div class="size-button Heading u-h6 py-5 text-left " style="width: 100%;text-align: right;">
                            <a href="{{ route('size-chart') }}" target="_blank" class="btn btn-dark bg-black" style="border-radius: 0;">Size Chart</a>
                        </div>
                        <div class="" style="width: 100%;">
                            <a data-spiff-hide data-product-id="{{ $product->product_code }}"
                                href="{{ $product->product_link }}" target="_blank"
                                class="btn btn-dark h-45px bg-black" style="display: block; border-radius: 0;">
                                <span>BUY NOW</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="Container">
                    <div class="d-flex flex-column-fluid flex-center bg-transparent ProductMeta pt-5">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-front-layout>
