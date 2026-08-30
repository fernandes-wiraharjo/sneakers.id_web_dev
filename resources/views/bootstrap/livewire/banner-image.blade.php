<div class="container-fluid pt-3 pb-5">
    <div class="row">
        <div class="col-12 px-0">
            <div class="slick-banner">
                @foreach ($banner as $item)
                @php 
                    $banner_url = $item->banner_url ?? 'javascript:void(0)';
                    $target = '_self';
                    if ($banner_url && \Str::startsWith($banner_url, 'http')) {
                        if (!\Str::contains($banner_url, config('app.url'))) {
                            $target = '_blank';
                        }
                    }
                @endphp
                <div class="ratio" style="--bs-aspect-ratio: 50%">
                    <a href="{{ $banner_url }}" target="{{ $target }}">
                        <img class="px-1 px-md-3 img-fluid rounded-5 rounded-sm-3 object-fit-cover" src="{{ getImage($item->banner_image, 'banner') }}" alt="{{ $item->banner_description }}">
                    </a>
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