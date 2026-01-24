@extends('bootstrap.layout')

@section('title', 'SEARCH PRODUCT')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 header-image-wrapper">
            <img src="{{ $headerImageURL }}" alt="Search Results" class="w-100">
        </div>
    </div>
</div>
<div class="container border-1 shadow rounded-4 py-4 px-3 bg-white position-relative z-1 product-list-container">
    <div class="row">
        <div class="col-12 col-md-8">
            <h1 class="fw-bold text-uppercase">BLOG</h1>
        </div>
        <div class="col-12 col-md-4">
            <form action="{{ route('blog.search') }}" method="get">
                <div class="input-group rounded-pill border py-1 px-2">
                    <span class="input-group-text rounded-pill bg-white border-0 pe-0">
                        <span class="iconify fs-4" data-icon="material-symbols:search-rounded"></span>
                    </span>
                    <input type="text" class="form-control border-0" name="q" placeholder="Search keyword..." aria-label="Search">
                    <button type="button" class="btn btn-dark rounded-pill px-4 shadow">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="blog-carousel">
                @foreach ($blog_carousel as $item)
                <a href="{{ route('blog.show', $item->slug) }}" class="px-3">
                    <div class="blog-carousel-item">
                        <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
                        <div>
                            <h2 class="fs-4 text-white fw-bold">{{ $item->title }}</h2>
                            <p class="text-danger mb-0">{{ $item->author }} - {{ date('d F Y', strtotime($item->created_at)) }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 col-md-8 pe-md-5">
            <div class="d-flex align-items-center justify-content-start mb-3">
                <h3 class="fw-bold text-uppercase nowrap mb-0">PROMO SNEAKERS.ID</h3>
                <hr class="w-100 ms-3">
            </div>
            @php
            $count_promo = count($blog_promo)
            @endphp
            @forelse ($blog_promo as $index => $item)
            <a href="{{ route('blog.show', $item->slug) }}"> 
                <div class="row">
                    <div class="col-4">
                        <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
                    </div>
                    <div class="col-8">
                        <h2 class="fs-5 fw-bold">{{ $item->title }}</h2>
                        <p class="text-danger">{{ date('d F Y', strtotime($item->created_at)) }}</p>
                        <p class="text-muted">{{ $item->excerpt }}</p>
                        @if ($index < $count_promo - 1)
                        <hr>
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-12">
                <p>No promo blog posts</p>
            </div>
            @endforelse

            @if ($count_promo > 0)
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('blog.category', 'promo') }}" class="btn btn-dark px-4 d-flex align-items-center w-fit-content">
                    <span class="lh-1">Load More</span>
                    <i class="iconify fs-4" data-icon="eva:arrow-down-fill"></i>
                </a>
            </div>
            @endif

            <div class="row">
                <div class="col-12">            
                    <div class="d-flex align-items-center justify-content-start mb-3 mt-5">
                        <h3 class="fw-bold text-uppercase nowrap mb-0">LATEST ARTICLES</h3>
                        <hr class="w-100 ms-3">
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($blog_latest as $item)
                <div class="col-12 col-md-6 mb-3">
                    <a href="{{ route('blog.show', $item->slug) }}">
                        <img class="img-fluid rounded-4" src="{{ $item->featured_image_url }}" alt="{{ $item->title }}">
                    </a>
                    @if($item->category)
                        <a href="{{ url('blog/category/' . $item->category->id) }}" class="category-pills mt-2 d-inline-block">
                            {{ $item->category->name }}
                        </a>
                    @endif
                    <a href="{{ route('blog.show', $item->slug) }}">
                        <h2 class="fs-5 fw-bold my-2">{{ $item->title }}</h2>
                    </a>
                    <p class="text-danger mb-0">{{ date('d F Y', strtotime($item->created_at)) }}</p>
                </div>
                @empty
                <div class="col-12">
                    <p>No latest blog posts</p>
                </div>
                @endforelse

                
                @if (count($blog_latest) > 0)
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('blog.all') }}" class="btn btn-dark px-4 d-flex align-items-center w-fit-content">
                        <span class="lh-1">Load More</span>
                        <i class="iconify fs-4" data-icon="eva:arrow-down-fill"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-md-4">
            @include('bootstrap.parts.blog-sidebar', ['popular' => $blog_popular, 'brands' => $brands])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('.blog-carousel').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: true,
        dots: true,
    });
</script>
@endpush

@push('styles')
<style>
    .blog-carousel-item {
        position: relative;
    }
    .blog-carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .blog-carousel-item div {
        position: absolute;
        bottom: 0;
        left: 0;
        padding: 1.5rem 1rem;
    }
</style>
@endpush