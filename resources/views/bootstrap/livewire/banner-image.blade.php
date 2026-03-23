<div class="container-fluid pt-3 pb-5">
    <div class="row">
        <div class="col-12 px-0">
            <div class="slick-banner">
                @foreach ($banner as $item)
                <div class="ratio ratio-21x9">
                    <img class="px-1 px-md-3 img-fluid rounded-5 rounded-sm-3 object-fit-cover" src="{{ getImage($item->banner_image, 'banner') }}" alt="{{ $item->banner_description }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        @media screen and (max-width: 768px) {
            .slick-banner .rounded-sm-3 {
                border-radius: 0.775rem !important;
            }
        }
    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.slick-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '10%',
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerPadding: '4%',
                    }
                }
            ]
        });
    });
</script>
@endpush