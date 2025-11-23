<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="slick-banner">
                @foreach ($banner as $item)
                <div class="ratio ratio-21x9">
                    <img class="px-3 img-fluid rounded-5 object-fit-cover" src="{{ getImage($item->banner_image, 'banner') }}" alt="{{ $item->banner_description }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.slick-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '10%',
            autoplay: true,
            autoplaySpeed: 3000,
            arrow: false,
            dots: false,
        });
    });
</script>