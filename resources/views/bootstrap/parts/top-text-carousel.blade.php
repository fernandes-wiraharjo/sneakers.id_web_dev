@if($top_text_carousel->count() > 0)
<div class="container-fluid bg-black text-white">
    <div class="row">
        <div class="col-12 text-center">
            <div class="slick-top-text-carousel py-2">
                @foreach($top_text_carousel as $item)
                    <a href="{{ $item->link }}" class="item">
                        <span>{{ $item->text }}</span>
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
        $('.slick-top-text-carousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: true,
            infinite: true,
            prevArrow: '<button type="button" class="slick-prev ms-md-5"><span class="iconify fs-2 text-white" data-icon="mdi:chevron-left"></span></button>',
            nextArrow: '<button type="button" class="slick-next me-md-5"><span class="iconify fs-2 text-white" data-icon="mdi:chevron-right"></span></button>',
        });
    });
</script>
@endpush