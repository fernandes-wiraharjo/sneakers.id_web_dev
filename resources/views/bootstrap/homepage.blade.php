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

    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-2">
                    TODO: Customer Review
                </h1>
            </div>
        </div>
    </div>

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
    </style>
@endpush