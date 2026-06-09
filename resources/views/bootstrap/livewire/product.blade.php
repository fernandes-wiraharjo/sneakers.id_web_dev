@php
$selectedThumbStyle = 'border rounded-3 border-dark shadow'
@endphp
<div class="container pb-5 pt-md-5">
    <div class="row">
        <div class="col-12 col-md-8" wire:ignore>
            <div class="row sticky-top">
                <div class="d-none d-md-flex col-md-2 flex-column gap-2" id="thumbnail-container" style="overflow-y: auto; overflow-x: hidden;">
                    @foreach ($product->images as $index => $item)
                    <div class="ratio ratio-1x1 product-thumbnail-container {{ $index == 0 ? $selectedThumbStyle : ''}}" style="cursor: pointer; flex-shrink: 0;">
                        <img src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-3 product-thumbnail" data-full-image="{{ getImage($item->image_url, 'products/' . $product->product_code) }}">
                    </div>
                    @endforeach
                </div>
                <div class="col-12 col-md-10">
                    <div class="ratio ratio-1x1" id="main-image-container">
                        <img id="main-product-image" src="{{ getImage($product->images[0]->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-4">
                    </div>
                    
                    <div class="my-3 d-flex flex-nowrap gap-3 d-md-none overflow-x-auto overflow-y-hidden" style="-webkit-overflow-scrolling: touch">
                        @foreach ($product->images as $index => $item)
                        <div class="ratio ratio-1x1 flex-shrink-0 product-thumbnail-container {{ $index == 0 ? $selectedThumbStyle : ''}}" style="width: 100px; height: 100px; cursor: pointer;">
                            <img src="{{ getImage($item->image_url, 'products/' . $product->product_code) }}" alt="{{ $product->product_name }}" class="img-fluid rounded-3 product-thumbnail" data-full-image="{{ getImage($item->image_url, 'products/' . $product->product_code) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <p class="text-muted mb-2">{{ $product->product_code }}</p>
            <h1 class="fw-bold">{{ $product->product_name }}</h1>
            <div wire:ignore>
                <div id="product-description" class="product-description-text" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                    {!! $product->description !!}
                </div>
                <button id="read-more-btn" class="btn btn-link p-0 text-danger text-decoration-none mt-2" style="display: none; font-size: 0.875rem;">
                    <span id="read-more-text">Read more</span>
                </button>
            </div>
            <div class="d-flex justify-content-between">
                <span class="fw-bold">SELECT SIZE</span>
                @if(isset($size_chart_image) && $size_chart_image)
                    <a href="javascript:void(0)" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#sizeModal">
                        Size Chart
                    </a>
                @endif
            </div>
            <div class="d-flex flex-wrap justify-content-start gap-2">
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
            @if ($retailPrice != $originalPrice)
            <div class="text-danger mt-3 fs-5" wire:key="price-display-{{ $size ?? 'default' }}">
                <del class="fw-bold">{{ rupiah_format($originalPrice, true) }}</del>
                @if($discountPercentage > 0)
                <span class="text-danger ps-3">{{ $discountPercentage }}% OFF</span>
                @endif
            </div>
            @endif
            <p class="fs-1 fw-bold anton" wire:key="price-amount-{{ $size ?? 'default' }}">
                {{ rupiah_format($retailPrice, true) }}
            </p>

            @php
            $can_buy = count($sizeList) > 0;
            if ($can_buy && count($sizeList) < 2 && ($sizeList[0]->size == null || $sizeList[0]->size == '')) {
                $can_buy = false;
            }
            @endphp
            @if ($can_buy)
            <button wire:click="addToCart" class="btn btn-danger rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Add to Cart</span> 
                <span class="iconify fs-5" data-icon="uil:cart"></span>
            </button>
            @else
            <button class="btn btn-danger rounded-pill w-100" disabled>Out of Stock</button>
            @endif

            @if (!empty($link_toggles['tokopedia']) && $product->product_link)
            <a href="{{ $product->product_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Tokopedia</span> 
            </a>
            @endif

            @if (!empty($link_toggles['shopee']) && $product->shopee_link)
            <a href="{{ $product->shopee_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Shopee</span> 
            </a>
            @endif

            @if (!empty($link_toggles['tiktok']) && $product->tiktok_link)
            <a href="{{ $product->tiktok_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via TikTok</span> 
            </a>
            @endif

            @if (!empty($link_toggles['blibli']) && $product->blibli_link)
            <a href="{{ $product->blibli_link }}" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via Blibli</span> 
            </a>
            @endif

            @if (!empty($link_toggles['whatsapp']))
            <a href="http://wa.me/6289617925925" target="_blank" class="mt-3 btn btn-dark rounded-pill w-100 d-flex align-items-center justify-content-center gap-2 py-2 shadow">
                <span class="lh-1">Order via WhatsApp</span> 
            </a>
            @endif

            @if(isset($reviews) && count($reviews['data']) > 0)
            <div class="mt-5">
                <div class="card rounded-4 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold mb-0">Review ({{ $reviews['summary']['count'] }})</h4>
                        <div class="d-flex align-items-center gap-2 fs-4">
                            @php
                            $rating = number_format($reviews['summary']['rating'], 1);
                            @endphp
                            @for($i = 0; $i < floor($rating); $i++)
                                <span class="iconify text-warning" data-icon="material-symbols:star"></span>
                            @endfor
                            @if($rating > floor($rating) + 0.5 && $rating < ceil($rating))
                                <span class="iconify text-warning" data-icon="material-symbols:star-half"></span>
                            @endif
                            @for($i = ceil($rating); $i < 5; $i++)
                                <span class="iconify text-secondary" data-icon="material-symbols:star"></span>
                            @endfor
                        </div>
                    </div>
                    @foreach($reviews['data'] as $review)
                    <div class="row mt-3 align-items-center">
                        <div class="col-12 col-md-5 fs-5">
                            @for($i = 0; $i < $review['rating']; $i++)
                                <span class="iconify text-warning" data-icon="material-symbols:star"></span>
                            @endfor
                            @for($i = $review['rating']; $i < 5; $i++)
                                <span class="iconify text-secondary" data-icon="material-symbols:star"></span>
                            @endfor
                        </div>
                        <div class="col-12 col-md-7 text-secondary text-end">
                            {{ $review->reviewer_name }} - {{ date('d/m/Y', strtotime($review->created_at)) }}
                        </div>
                        <div class="col-12 text-secondary">
                            {{ $review['review'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Size Chart Modal -->
<div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-uppercase" id="sizeModalLabel">Size Chart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @if(isset($size_chart_image) && $size_chart_image)
                    <img src="{{ $size_chart_image }}" alt="Size Chart" class="img-fluid">
                @else
                    <p class="mb-3">No size chart available for this product.</p>
                    <a href="{{ route('size-chart') }}" target="_blank" class="btn btn-primary">View General Size Chart</a>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Match thumbnail container height to main image height
        function matchThumbnailHeight() {
            var mainImageHeight = $('#main-image-container').outerHeight();
            if (mainImageHeight > 0) {
                $('#thumbnail-container').css('height', mainImageHeight + 'px');
            }
        }
        
        // Initial height match after images load
        $(window).on('load', function() {
            setTimeout(matchThumbnailHeight, 100);
        });
        
        // Also try immediately in case images are already loaded
        setTimeout(matchThumbnailHeight, 100);
        
        // Update on window resize
        $(window).on('resize', function() {
            matchThumbnailHeight();
        });
        
        // Handle thumbnail click for both mobile and desktop (delegated — survives inside wire:ignore)
        $(document).on('click', '.product-thumbnail', function() {
            var fullImageUrl = $(this).data('full-image');
            if (fullImageUrl) {
                $('#main-product-image').attr('src', fullImageUrl);
                
                // Optional: Add active state to clicked thumbnail
                $('.product-thumbnail-container').removeClass('{{ $selectedThumbStyle }}');
                $(this).closest('.product-thumbnail-container').addClass('{{ $selectedThumbStyle }}');
                
                // Recalculate height after image change
                setTimeout(matchThumbnailHeight, 100);
            }
        });
        
        // Read more/read less functionality for product description
        function initReadMore() {
            var $description = $('#product-description');
            var $btn = $('#read-more-btn');
            var $btnText = $('#read-more-text');
            var originalHeight = $description[0].scrollHeight;
            var lineHeight = parseInt($description.css('line-height')) || 24;
            var maxHeight = lineHeight * 3; // 3 lines
            
            // Check if content exceeds 3 lines
            if (originalHeight > maxHeight) {
                $btn.show();
                $description.css({
                    'max-height': maxHeight + 'px',
                    'overflow': 'hidden'
                });
            }
            
            var isExpanded = false;
            $btn.off('click.readMore').on('click.readMore', function() {
                if (!isExpanded) {
                    $description.css({
                        'max-height': originalHeight + 'px',
                        'display': 'block',
                        '-webkit-line-clamp': 'unset',
                        '-webkit-box-orient': 'unset'
                    });
                    $btnText.text('Read less');
                    isExpanded = true;
                } else {
                    $description.css({
                        'max-height': maxHeight + 'px',
                        'display': '-webkit-box',
                        '-webkit-line-clamp': '3',
                        '-webkit-box-orient': 'vertical'
                    });
                    $btnText.text('Read more');
                    isExpanded = false;
                }
            });
        }
        
        // Initialize read more after content loads
        setTimeout(initReadMore, 100);
    });
</script>
@endpush