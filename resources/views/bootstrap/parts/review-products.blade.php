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
                                <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->reviewer_name }}" class="rounded-circle me-2" style="max-height: 45px;">
                            @endif
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-bold">{{ $review->reviewer_name }}</p>
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
                            {{ Str::limit($review->review, 180) }}
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
                                <img src="{{ $review->user->profile_photo_url }}" alt="{{ $review->reviewer_name }}" class="rounded-circle me-2" style="max-height: 45px;">
                            @endif
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-bold">{{ $review->reviewer_name }}</p>
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
                            {{ Str::limit($review->review, 180) }}
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


@push('scripts')
    <script>
        $(document).ready(function() {

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