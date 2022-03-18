<script>
    $('.Product__SlideshowNavImage').click(function(){
        $('.Product__SlideItem').removeClass('is-selected');
        $('.Product__SlideItem').css('left', '100%');
        $('.Product__SlideItem').eq($(this).index()).addClass('is-selected');
        $('.Product__SlideItem').eq($(this).index()).css('left', '0%');
        $('.Product__SlideshowNavImage').removeClass('is-selected');
        $('.Product__SlideshowNavImage').eq($(this).index()).addClass('is-selected');
        $('.flickity-page-dots .dot').removeClass('is-selected')
        $('.flickity-page-dots .dot').eq($(this).index()).addClass('is-selected');
    });

    $('.Popover__Value').click(function(){
        $('html').removeClass('no-scroll');
    });

    var product_variants_removed = [];
</script>
@stack('scripts')
