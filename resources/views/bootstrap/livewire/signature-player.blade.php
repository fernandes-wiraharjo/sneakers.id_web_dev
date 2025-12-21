@if ($signature_carousel && count($signature_carousel) > 0)
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <div class="slick-signature">
                @foreach ($signature_carousel as $item)
                    <img src="{{ $item['signature_image'] }}" alt="{{ $item['signature_title'] }}" class="w-100">
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    $(document).ready(function() {
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
</style>
@endpush