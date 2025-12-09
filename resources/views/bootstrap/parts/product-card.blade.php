@php
    $image_url = getImage($item->image, 'products/'.$item->product_code);
    $title = $item->product_name;
    $price = $item->retail_price;
    $discount_percentage = $item->discount_percentage;
    $selling_price = $item->after_discount_price;
@endphp
<a href="{{ route('product-detail', [$item->id, str_replace(' ', '_', $item->product_name)]) }}">
    <div class="card shadow rounded-5 h-100 position-relative">
        <span class="iconify fs-3 position-absolute text-secondary top-0 end-0 mt-3 me-3" data-icon="uil:cart"></span>
        <img src="{{ $image_url }}" class="card-img-top rounded-top-5" alt="...">
        <div class="card-body">
            <p class="mb-1 text-uppercase">{{ $title }}</p>
            <p class="mb-1 text-danger">
                <span class="fw-bolder text-decoration-line-through">{{ rupiah_format($price) }}</span>
                <span>{{ $discount_percentage }}% OFF</span>
            </p>
            <p class="anton fs-5 mb-0">
                {{ rupiah_format($selling_price) }}
            </p>    
        </div>
    </div>
</a>