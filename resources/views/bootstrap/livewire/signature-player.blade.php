@if ($signature_carousel && count($signature_carousel) > 0)
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <div class="slick-signature">
                @foreach ($signature_carousel as $item)
                <a href="{{ route('collections', 'signatures.' . $item['signature_code']) }}" class="position-relative signatureOverlay" data-id="{{ $item['id'] }}">
                    <img src="{{ $item['signature_image'] }}" alt="{{ $item['signature_title'] }}" class="w-100">
                    <div class="position-absolute top-0 start-0 w-100 h-100 signatureOverlay-{{ $item['id'] }}" style="display: none; background-color: rgba(0, 0, 0, 0.25);">
                        <div class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center">
                            <h3 class="text-white">{{ $item['signature_title'] }}</h3>
                            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center">
                                <span class="iconify fs-2 text-dark" data-icon="stash:arrow-right-duotone"></span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('mouseenter', '.signatureOverlay', function() {
            var id = $(this).data('id');
            $('.signatureOverlay-' + id).show();
        });
        $('body').on('mouseleave', '.signatureOverlay', function() {
            var id = $(this).data('id');
            $('.signatureOverlay-' + id).hide();
        });
        $('.slick-signature').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            infinite: true,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev rounded-circle bg-white shadow-sm"><span class="iconify fs-2 text-dark" data-icon="stash:arrow-left-duotone"></span></button>',
            nextArrow: '<button type="button" class="slick-next rounded-circle bg-white shadow-sm"><span class="iconify fs-2 text-dark" data-icon="stash:arrow-right-duotone"></span></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                    }
                }
            ]
        });
    });
</script>
@endpush

@push('styles')
<style>
    .slick-signature .slick-prev {
        left: 1rem;
    }
    .slick-signature .slick-next {
        right: 1rem;
    }
    .signatureOverlay .rounded-circle {
        width: 40px;
        height: 40px;
    }
    @media screen and (max-width: 576px) {
        .signatureOverlay > div {
            display: flex !important;
        }        
    }
</style>
@endpush