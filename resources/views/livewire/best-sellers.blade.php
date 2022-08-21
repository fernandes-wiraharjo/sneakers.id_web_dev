<div class="tns tns-default mb-10 tns-initiazlied">
    <!--begin::Wrapper-->
    <div class="tns-outer" id="bs-tns1-ow">
        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">7
                to 9</span> of 7</div>
        <div id="bs-tns1-mw" class="tns-ovh">
            <div class="tns-inner" id="bs-tns1-iw">
                <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
                    data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
                    data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
                    data-tns-prev-button="#bs-item-prev" data-tns-next-button="#bs-item-next"
                    data-tns-responsive="{1200: {items: 4}, 992: {items: 2}}"
                    class="  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="bs-tns1"
                    data-kt-initialized="1" style="transform: translate3d(-40%, 0px, 0px);">
                    @foreach ($products as $item)
                    @php
                        $image_size = getimagesize(getImage($item->image, 'products/'.$item->product_code));
                        $ratio = $image_size[0] / $image_size[1];
                    @endphp
                    {{-- <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}"> --}}
                        <!--begin::item-->
                        <div class="text-center tns-item tns-slide-cloned p-5" aria-hidden="true" tabindex="-1">
                            <!--begin::Photo-->
                            @foreach ($item->images()->limit(1)->get() as $key => $image)
                            <div class="mx-auto mb-5 d-flex w-200px h-200px bgi-no-repeat bgi-size-contain bgi-position-center"
                                style="background-image:url('{{ getImage($image->image_url, 'products/'.$item->product_code) }}')"></div>
                            @endforeach
                            <!--end::Photo-->
                            <!--begin::Person-->
                            <div class="mb-0">
                                <!--begin::Name-->
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-3">{{$item->detail->brand->brand_title}}</a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1 mh-40px" style="overflow-wrap: break-word; min-height: 45px;">
									{{-- item Name --}}
										<a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">{{$item->product_name}}</a>
								</span>
                                <!--begin::Position-->
                                <!--begin::Total-->
                                <span class="text-danger text-end fw-bold fs-1">
                                    @if ($item->detail->after_discount_price > 0 && $item->detail->after_discount_price < $item->detail->retail_price)
                                        <span class="money">
                                            RP
                                            <del>
                                                {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                            </del>
                                            <span style="position:inherit; font-weight: 800;">
                                                {{ rupiah_format(intval($item->detail->after_discount_price ?? 0)) }}</span>
                                        </span>
                                    @else
                                        <span class="money" >RP
                                            {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                        </span>
                                    @endif
                                </span>
                                <!--end::Total-->
                            </div>
                            <!--end::Person-->
                        </div>
                        <!--end::Item-->
                    {{-- </a> --}}
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!--end::Wrapper-->
    <!--begin::Button-->
    <button class="btn btn-icon btn-active-color-primary" id="bs-item-prev" aria-controls="bs-tns1"
        tabindex="-1" data-controls="prev">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
        <span class="svg-icon svg-icon-3x">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->
    </button>
    <!--end::Button-->
    <!--begin::Button-->
    <button class="btn btn-icon btn-active-color-primary" id="bs-item-next" aria-controls="bs-tns1"
        tabindex="-1" data-controls="next">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
        <span class="svg-icon svg-icon-3x">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                    fill="currentColor"></path>
            </svg>
        </span>
        <!--end::Svg Icon-->
    </button>
    <!--end::Button-->
</div>
