@extends('bootstrap.layout')

@section('title', 'Home')
@section('description', 'Homepage of SNEAKERS.ID')

@section('content')
    @livewire('banner-image')

    <div class="container-fluid" id="featured-products">
        <div class="row bg-black text-white align-items-center">
            <div class="col-12 col-md-4 p-0">
                <img src="{{ asset('stores-info/homepage-featured.webp') }}" alt="Featured Product" class="img-fluid">
            </div>
            <div class="col-12 col-md-8 py-5 px-md-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>New Release</h2>
                    <a href="{{ route('collections', 'new-release') }}">
                        VIEW ALL <span class="iconify fs-3" data-icon="stash:arrow-right-duotone"></span>
                    </a>
                </div>
                <div class="mt-5 slick-featured-products">
                    @forelse ($new_release as $item)
                        <div class="px-2 h-100">
                            @include('bootstrap.parts.product-card', ['item' => $item])
                        </div>
                    @empty
                        <div class="text-center py-5 my-5">
                            <p>No new release products</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-between align-items-center">
                    <h2>Best Sellers</h2>
                    <a href="{{ route('collections', 'best-seller') }}">
                        VIEW ALL <span class="iconify fs-3" data-icon="stash:arrow-right-duotone"></span>
                    </a>
                </div>
                <div class="mt-5 slick-featured-products">
                    @forelse ($best_seller as $item)
                        <div class="px-2 h-100">
                            @include('bootstrap.parts.product-card', ['item' => $item])
                        </div>
                    @empty
                        <div class="text-center py-5 my-5">
                            <p>No best seller products</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-12 slick-brand">
                @foreach ($brand as $item)
                <div class="px-2">
                    <a href="{{ route('collections', 'all.' . $item->brand_code) }}">
                        <img style="max-height: 150px" src="{{ getImage($item->brand_image, 'brand') }}" alt="{{ $item->brand_title }}" class="img-fluid">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @livewire('signature-player')

    @if(isset($reviews_line1) && $reviews_line1->isNotEmpty())
    <div class="container-fluid bg-black py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="text-white text-uppercase fw-bold">CUSTOMER REVIEW</h2>
            </div>
        </div>
        
        @if($reviews_line1->isNotEmpty())
        <div class="row mb-4">
            <div class="col-12">
                <div class="slick-reviews-line1" dir="rtl">
                    @foreach($reviews_line1 as $review)
                    <div class="review-card px-2" dir="ltr">
                        <div class="bg-dark rounded-5 text-white p-3">
                            <div class="d-flex align-items-center">
                                @if($review->user && $review->user->profile_photo_url)
                                    <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}" class="rounded-circle me-2" style="max-height: 45px;">
                                @endif
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold">{{ $review->user->name ?? 'Anonymous' }}</p>
                                    <p class="mb-0 text-secondary">sneakers.id</p>
                                </div>
                                <img src="{{ asset('stores-info/logo-white-new.png') }}" alt="Rating" class="img-fluid" style="max-height: 60px;">
                            </div>
                            <p class="fw-bold fs-4 d-flex align-items-center mb-0">
                                <span class="me-2">{{ number_format($review->rating, 1) }}</span>
                                @for($i = 0; $i < $review->rating; $i++)
                                    <span class="iconify text-warning" data-icon="material-symbols:star"></span>
                                @endfor
                                @for($i = $review->rating; $i < 5; $i++)
                                    <span class="iconify text-secondary" data-icon="material-symbols:star"></span>
                                @endfor
                            </p>
                            <p class="mb-0">
                                {{ Str::limit($review->review, 120) }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        
        @if($reviews_line2->isNotEmpty())
        <div class="row mb-4">
            <div class="col-12">
                <div class="slick-reviews-line2" dir="ltr">
                    @foreach($reviews_line2 as $review)
                    <div class="review-card px-2" dir="ltr">
                        <div class="bg-dark rounded-5 text-white p-3">
                            <div class="d-flex align-items-center">
                                @if($review->user && $review->user->profile_photo_url)
                                    <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->user->name }}" class="rounded-circle me-2" style="max-height: 45px;">
                                @endif
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-bold">{{ $review->user->name ?? 'Anonymous' }}</p>
                                    <p class="mb-0 text-secondary">sneakers.id</p>
                                </div>
                                <img src="{{ asset('stores-info/logo-white-new.png') }}" alt="Rating" class="img-fluid" style="max-height: 60px;">
                            </div>
                            <p class="fw-bold fs-4 d-flex align-items-center mb-0">
                                <span class="me-2">{{ number_format($review->rating, 1) }}</span>
                                @for($i = 0; $i < $review->rating; $i++)
                                    <span class="iconify text-warning" data-icon="material-symbols:star"></span>
                                @endfor
                                @for($i = $review->rating; $i < 5; $i++)
                                    <span class="iconify text-secondary" data-icon="material-symbols:star"></span>
                                @endfor
                            </p>
                            <p class="mb-0">
                                {{ Str::limit($review->review, 120) }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center">
                <!-- Cached Instagram Feed (24h cache) -->
                <div class="ratio ratio-16x9" style="min-height: 500px;">
                    <iframe 
                        src="{{ route('instagram.feed') }}" 
                        frameborder="0" 
                        scrolling="no"
                        loading="lazy"
                        title="Instagram Feed"
                        class="w-100 h-100">
                    </iframe>
                </div>
                <div class="text-end mt-2">
                    <small class="text-muted">Feed updates every 24 hours</small>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <img src="{{ asset('stores-info/qna-top.png') }}" alt="FAQ Image" class="img-fluid">
                <p class="mt-5 mb-2">FAQ</p>
                <h2 class="text-black fw-bold">APA PERTANYAAN POPULER TENTANG SNEAKERS.ID?</h2>
                <p class="fs-5 text-secondary">Berikut beberapa pertanyaan umum tentang SNEAKERS</p>
            </div>
            <div class="col-12 col-md-6">
                @include('bootstrap.parts.faq-content', ['faq' => $faq])
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.slick-featured-products').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                infinite: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev rounded-circle bg-white shadow-sm"><span class="iconify fs-2 text-dark" data-icon="stash:arrow-left-duotone"></span></button>',
                nextArrow: '<button type="button" class="slick-next rounded-circle bg-white shadow-sm"><span class="iconify fs-2 text-dark" data-icon="stash:arrow-right-duotone"></span></button>',
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true,
                            centerMode: true,
                            centerPadding: '6%',
                        }
                    }
                ]
            });
            $('.slick-brand').slick({
                slidesToShow: 7,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
                infinite: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });
            
            // Reviews carousel - Line 1 (RTL true)
            @if(isset($reviews_line1) && $reviews_line1->isNotEmpty())
            $('.slick-reviews-line1').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 3000,
                cssEase: "linear",
                infinite: true,
                arrows: false,
                rtl: true,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
            @endif
            
            // Reviews carousel - Line 2 (RTL false)
            @if(isset($reviews_line2) && $reviews_line2->isNotEmpty())
            $('.slick-reviews-line2').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 0,
                speed: 3000,
                cssEase: "linear",
                infinite: true,
                arrows: false,
                rtl: false,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
            @endif
        });
    </script>
@endpush

@push('styles')
    <style>
        .slick-prev, .slick-next {
            width: 45px;
            height: 45px;
            z-index: 9;
        }
        .slick-next:before, .slick-prev:before {
            content: none;
        }
        
        /* Review cards equal height */
        .slick-reviews-line1 .slick-track,
        .slick-reviews-line2 .slick-track {
            display: flex;
            align-items: stretch;
        }
        
        .slick-reviews-line1 .slick-slide,
        .slick-reviews-line2 .slick-slide {
            height: auto;
        }
        
        .slick-reviews-line1 .slick-slide > div,
        .slick-reviews-line2 .slick-slide > div {
            height: 100%;
        }
        
        .review-card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .review-card > div {
            display: flex;
            flex-direction: column;
            height: 100%;
            flex-grow: 1;
        }
        
        .review-card > div > p:last-child {
            flex-grow: 1;
        }
        
        .review-card:hover > div {
            border: 1px solid var(--bs-warning);
        }
    </style>
@endpush