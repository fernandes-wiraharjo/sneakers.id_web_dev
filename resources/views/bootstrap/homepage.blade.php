@extends('bootstrap.layout')

@section('content')
    @livewire('banner-image')

    <div class="container-fluid" id="featured-products">
        <div class="row bg-black text-white align-items-center">
            <div class="col-12 col-md-4 p-0">
                <img src="{{ asset('stores-info/homepage-featured.webp') }}" alt="Featured Product" class="img-fluid">
            </div>
            <div class="col-12 col-md-8 p-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>New Release</h2>
                    <a href="{{ route('collections', 'new-release') }}">
                        VIEW ALL <span class="iconify fs-3" data-icon="stash:arrow-right-duotone"></span>
                    </a>
                </div>
                <div class="mt-5 slick-featured-products">
                    @forelse ($new_release as $item)
                        <div class="px-2">
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
                        <div class="px-2">
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
                            dots: true
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