@php
$selectedThumbStyle = 'border rounded-3 border-dark shadow'
@endphp
<div class="container pb-5 pt-md-5">
    <div class="row">
        <div class="d-none d-md-flex col-md-2 flex-column gap-2">
            @foreach ($product->images as $index => $item)
            <div class="ratio ratio-1x1 product-thumbnail-container {{ $index == 0 ? $selectedThumbStyle : ''}}" style="cursor: pointer;">
                <img src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-3 product-thumbnail" data-full-image="{{ getImage($item->image_url, 'products/' . $product->product_code) }}">
            </div>
            @endforeach
        </div>
        <div class="col-12 col-md-6">
            <div class="ratio ratio-1x1">
                <img id="main-product-image" src="{{ getImage($product->images[0]->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-4">
            </div>
            
            <div class="my-3 d-flex flex-nowrap gap-3 d-md-none overflow-x-auto overflow-y-hidden" style="-webkit-overflow-scrolling: touch">
                @foreach ($product->images as $item)
                <div class="ratio ratio-1x1 flex-shrink-0 product-thumbnail-container {{ $index == 0 ? $selectedThumbStyle : ''}}" style="width: 100px; height: 100px; cursor: pointer;">
                    <img src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-3 product-thumbnail" data-full-image="{{ getImage($item->image_url, 'products/' . $product->product_code) }}">
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-4">
            <p class="text-muted mb-2">{{ $product->product_code }}</p>
            <h1 class="fw-bold">{{ $product->product_name }}</h1>
            <div>
                {!! $product->description !!}
            </div>
            <div class="d-flex justify-content-between">
                <span class="fw-bold">SELECT SIZE</span>
                <a href="javascript:void(0)" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#sizeModal">
                    Size Chart
                </a>    
            </div>
            <div class="d-flex justify-content-start gap-2">
                @foreach ($sizeList as $variant)
                <input type="radio" class="btn-check" name="size" value="{{ $variant->id }}" id="btn-check-{{ $variant->id }}" autocomplete="off" wire:click="updatePrice({{ $variant->id }})" {{ ($size ?? null) == $variant->id ? 'checked' : '' }}>
                <label class="btn btn-light" for="btn-check-{{ $variant->id }}">{{ $variant->size }}</label>
                @endforeach
            </div>

            @php
            $originalPrice = $showRetailPrice ?? $product->detail->retail_price;
            $discountPrice = $showDiscountPrice ?? $product->detail->after_discount_price;
            $retailPrice = $discountPrice != 0 ? $discountPrice : $originalPrice;
            $discountPercentage = $showDiscountPercentage ?? $product->detail->discount_percentage;
            @endphp
            <div class="text-danger mt-3 fs-5" wire:key="price-display-{{ $size ?? 'default' }}">
                <del class="fw-bold">{{ rupiah_format($originalPrice) }}</del>
                @if($discountPercentage > 0)
                <span class="text-danger ps-3">{{ $discountPercentage }}% OFF</span>
                @endif
            </div>
            <p class="fs-1 fw-bold anton" wire:key="price-amount-{{ $size ?? 'default' }}">
                {{ rupiah_format($retailPrice) }}
            </p>

            @php
            $can_buy = true;
            if (count($sizeList) < 2 && ($sizeList[0]->size == null || $sizeList[0]->size == '')) $can_buy = false;
            @endphp
            @if ($can_buy)
            <button wire:click="addToCart" class="btn btn-danger rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Add to Cart</span> 
                <span class="iconify fs-5" data-icon="uil:cart"></span>
            </button>
            @else
            <button class="btn btn-danger rounded-pill w-100" disabled>Out of Stock</button>
            @endif

            @if ($product->tokopedia_link)
            <a href="{{ $product->tokopedia_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Tokopedia</span> 
            </a>
            @endif

            @if ($product->shopee_link)
            <a href="{{ $product->shopee_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Shopee</span> 
            </a>
            @endif

            @if ($product->tiktok_link)
            <a href="{{ $product->tiktok_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via TikTok</span> 
            </a>
            @endif

            @if ($product->blibli_link)
            <a href="{{ $product->blibli_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Blibli</span> 
            </a>
            @endif

            <a href="http://wa.me/6289617925925" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via WhatsApp</span> 
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Handle thumbnail click for both mobile and desktop
        $('.product-thumbnail').on('click', function() {
            var fullImageUrl = $(this).data('full-image');
            if (fullImageUrl) {
                $('#main-product-image').attr('src', fullImageUrl);
                
                // Optional: Add active state to clicked thumbnail
                $('.product-thumbnail-container').removeClass('{{ $selectedThumbStyle }}');
                $(this).closest('.product-thumbnail-container').addClass('{{ $selectedThumbStyle }}');
            }
        });
    });
</script>
@endpush