
<div class="d-flex align-items-center justify-content-center mb-3">
    <hr class="w-50 me-3">
    <h3 class="mb-0 fw-bold text-uppercase nowrap">POPULAR</h3>
    <hr class="w-50 ms-3">
</div>
@forelse ($popular as $item)
    <div class="row align-items-center mb-3">
        <div class="col-7">
            @if($item->category)
                <a href="{{ url('blog/category/' . $item->category->id) }}" class="category-pills d-inline-block">
                    {{ $item->category->name }}
                </a>
            @endif
            <a href="{{ route('blog.show', $item->slug) }}">
                <h2 class="fs-5 fw-bold my-1">{{ $item->title }}</h2>
            </a>
            <p class="text-danger mb-0">{{ date('d F Y', strtotime($item->created_at)) }}</p>
        </div>
        <div class="col-5">
            <a href="{{ route('blog.show', $item->slug) }}">
                <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
            </a>
        </div>
    </div>
@empty
    <div class="col-12">
        <p>No popular blog posts</p>
    </div>
@endforelse

<div class="d-flex align-items-center justify-content-center mt-5 mb-3">
    <hr class="w-50 me-3">
    <h3 class="mb-0 fw-bold text-uppercase nowrap">BUY BY PRODUCT</h3>
    <hr class="w-50 ms-3">
</div>
@foreach ($brands as $brand)
    <a class="w-100 btn btn-dark mb-2" href="{{ route('collections', 'brand.' . $brand->brand_code) }}">
        {{ $brand->brand_title }}
    </a>
@endforeach


