@php
    $image_url = getImage($item->image, 'products/'.$item->product_code);
    $title = $item->product_name;
    $price = $item->retail_price;
    $selling_price = $item->after_discount_price;
    $discount_percentage = number_format(($price - $selling_price) / $price * 100, 0);
@endphp
<a class="h-100" href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">
    <div class="card shadow rounded-5 h-100 position-relative">
        <span class="z-2 iconify fs-3 position-absolute text-secondary top-0 end-0 mt-3 me-3" data-icon="uil:cart"></span>
        <div class="ratio ratio-1x1 z-1">
            <img src="{{ $image_url }}" class="object-fit-contain rounded-top-5 img-fluid" alt="...">
        </div>
        <div class="card-body">
            <p class="mb-1 text-uppercase" style="min-height: 3rem">{{ $title }}</p>
            @if ($discount_percentage > 0)
            <p class="mb-1 text-danger small">
                <span class="fw-bolder text-decoration-line-through">{{ rupiah_format($price) }}</span>
                <span>{{ $discount_percentage }}% OFF</span>
            </p>
            @endif
            <p class="anton fs-5 mb-0">
                {{ rupiah_format($selling_price) }}
            </p>    
        </div>
    </div>
</a>