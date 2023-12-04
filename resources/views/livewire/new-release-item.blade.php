@foreach ($products as $item)
@php
    $image_size = getimagesize(getImage($item->image, 'products/'.$item->product_code));
    $ratio = $image_size[0] / $image_size[1];
@endphp
<div class="Carousel__Cell">
    <div class="ProductItem">
        <div class="ProductItem__Wrapper">
            {{-- Item detail route --}}
            <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                <div class="AspectRatio AspectRatio--withFallback" style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: {{$ratio}};">

                    {{-- multi image --}}
                    @foreach ($item->images()->limit(2)->get() as $key => $image)
                        @if($item->image != $image->image_url)
                            <img class="ProductItem__Image ProductItem__Image--alternate  Image--lazyLoad Image--fadeIn"
                            {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                                data-src="{{ getImage($image->image_url, 'products/'.$item->product_code) }}"
                                data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                                alt='{{$item->product_name}}' data-image-id="{{$image->id}}" />
                        @endif
                    @endforeach

                    <img class="ProductItem__Image Image--lazyLoad Image--fadeIn"
                    {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                        data-src="{{ getImage($item->image, 'products/'.$item->product_code) }}"
                        data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                        alt='{{$item->product_name}}' data-image-id="{{$item->id}}" />

                    <span class="Image__Loader"></span>

                    <noscript>
                        @foreach ($item->images()->limit(2)->get() as $key => $image)
                        {{-- BOX-A2_600x.jpg?v=1644800500 --}}
                            @if($item->image != $image->image_url)
                                <img class="ProductItem__Image ProductItem__Image--alternate"
                                    src="{{ getImage($image->image_url, 'products/'.$item->product_code) }}"
                                    alt='{{$item->product_name}}' />
                            @endif
                        @endforeach

                        <img class="ProductItem__Image"
                            src="{{ getImage($item->image, 'products/'.$item->product_code) }}"
                            alt='{{$item->product_name}}' />

                    </noscript>
                </div>
            </a>
            <div class="ProductItem__Info ProductItem__Info--center">
                {{-- Brand --}}
                <p class="ProductItem__Vendor Heading">{{$item->brand->brand_title}}</p>
                <h2 class="ProductItem__Title Heading">
                    {{-- item Name --}}
                    <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">{{$item->product_name}}</a>
                </h2>
                {{-- base price if discount and count discount--}}
                <div class="ProductItem__PriceList Heading">
                    <span class="ProductItem__Price Price Text--subdued" data-money-convertible>
                        @if ($item->after_discount_price > 0 && $item->after_discount_price < $item->retail_price)
                            <div class="discount-money">
                                <span style="position:inherit; font-weight: 800; font-size: 16px; color:maroon;">
                                    Rp {{ rupiah_format(intval($item->after_discount_price ?? 0)) }}
                                </span>
                            </div>
                            <div class="del-price-money">
                                <span class="money">
                                    <del>
                                        RP {{ rupiah_format(intval($item->retail_price ?? 0)) }}
                                    </del>
                                </span>
                                &nbsp;
                                <br>
                                {{-- @if ($item->discount_percentage > 0) --}}
                                    <span class="disc-off" style="font-weight: 400; font-size: 14px; color:maroon;">
                                        {{ 100 - round((intval($item->after_discount_price) / intval($item->retail_price)) * 100, 0) }}% OFF
                                    </span>
                                {{-- @endif --}}
                            </div>
                        @else
                            <span class="money" >RP.
                                {{ rupiah_format(intval($item->retail_price ?? 0)) }}
                            </span>
                        @endif
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
