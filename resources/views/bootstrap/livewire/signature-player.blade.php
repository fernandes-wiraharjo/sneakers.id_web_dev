<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <!-- TODO: verify UI shows signature image after PR 300 merged -->
            <div class="slick-signature">
                @foreach ($signature_carousel as $item)
                    @if (isset($item['signature_image']) && $item['signature_image'] != '')
                        <img src="{{ $item['signature_image'] }}" alt="{{ $item['signature_title'] }}" class="img-fluid">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.slick-signature').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                }
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