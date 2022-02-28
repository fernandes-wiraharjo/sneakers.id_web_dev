@foreach ($products as $item)
<div class="Carousel__Cell">
    <div class="ProductItem">
        <div class="ProductItem__Wrapper">
            {{-- Item detail route --}}
            <a href="{{ route('product-detail', $item->id) }}" class="ProductItem__ImageWrapper ProductItem__ImageWrapper--withAlternateImage">
                <div class="AspectRatio AspectRatio--withFallback" style="max-width: 2000px; padding-bottom: 100%; --aspect-ratio: 1;">
                    {{-- multi image --}}
                    @foreach ($item->images()->get() as $key => $image)
                    <img class="ProductItem__Image {{$key == 0 ? 'ProductItem__Image--alternate' : ''}} Image--lazyLoad Image--fadeIn"
                    {{-- BOX-A2_{width}x.jpg?v=1644800500 --}}
                        data-src="{{ getImage($image->image_url, 'products') }}"
                        data-widths="[200,300,400,600,800,900,1000,1200]" data-sizes="auto"
                        alt='{{$item->product_name}}' data-image-id="{{$image->id}}" />
                    @endforeach

                    <span class="Image__Loader"></span>

                    <noscript>
                        @foreach ($item->images()->get() as $key => $image)
                        {{-- BOX-A2_600x.jpg?v=1644800500 --}}
                        <img class="ProductItem__Image {{$key == 0 ? 'ProductItem__Image--alternate' : ''}}"
                            src="{{ getImage($image->image_url, 'products') }}"
                            alt='{{$item->product_name}}' />
                        @endforeach
                    </noscript>
                </div>
            </a>
            <div class="ProductItem__Info ProductItem__Info--center">
                {{-- Brand --}}
                <p class="ProductItem__Vendor Heading">{{$item->detail->brand->brand_title}}</p>
                <h2 class="ProductItem__Title Heading">
                    {{-- item Name --}}
                    <a href="{{ route('product-detail', $item->id) }}">{{$item->product_name}}</a>
                </h2>
                {{-- base price if discount and count discount--}}
                <div class="ProductItem__PriceList Heading">
                    <span class="ProductItem__Price Price Text--subdued" data-money-convertible>
                        <span class="money">Rp. {{ rupiah_format($item->detail->base_price) }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
