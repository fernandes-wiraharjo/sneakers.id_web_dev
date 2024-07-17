@if($products->count() > 0)
    @foreach ($products as $item)
    <div class="Carousel__Cell">
        <div class="ProductItem">
            <div class="ProductItem__Wrapper">
                {{-- Item detail route --}}
                <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                    <div class="AspectRatio AspectRatio--withFallback" style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: 1;">
                        {{-- multi image --}}
                        @foreach ($item->images()->get() as $key => $image)
                        <img class="ProductItem__Image {{$key == 0 ? 'ProductItem__Image--alternate' : ''}} Image--lazyLoad Image--fadeIn"
                        {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                            data-src="{{ getImage($image->image_url, 'products') }}"
                            data-widths="[1800]" data-sizes="auto"
                            alt='{{$item->product_name}}' data-image-id="{{$image->id}}" />
                        @endforeach

                        <span class="Image__Loader"></span>
                    </div>
                </a>
                <div class="ProductItem__Info ProductItem__Info--center">
                    {{-- Brand --}}
                    <p class="ProductItem__Vendor Heading">{{$item->detail->brand->brand_title}}</p>
                    <h2 class="ProductItem__Title Heading">
                        {{-- item Name --}}
                        <a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">{{$item->product_name}}</a>
                    </h2>
                    {{-- base price if discount and count discount--}}
                    <div class="ProductItem__PriceList Heading">
                        <span class="ProductItem__Price Price Text--subdued" data-money-convertible>
                            @if ($item->detail->after_discount_price > 0 && $item->detail->after_discount_price < $item->detail->retail_price)
                                <span class="money">
                                    RP.
                                    <del>
                                        {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                    </del>
                                    <span style="position:inherit; font-weight: 800;">
                                        {{ rupiah_format(intval($item->detail->after_discount_price ?? 0)) }}</span>
                                </span>
                            @else
                                <span class="money" >RP.
                                    {{ rupiah_format(intval($item->detail->retail_price ?? 0)) }}
                                </span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
