<script type="text/javascript">
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
<script src="https://use.fontawesome.com/eeb42b6d4d.js"></script>

<script>
    document.getElementById("global_search").oninput = function() {
        $('.bc-sf-search-suggestion-popover').show();
        $('#ui-id-1').show();
        var search_query = this.value;
        $.ajax({
            type : 'get',
            url : '{{ route('search') }}',
            data : {'search': this.value ?? ''},
            success:function(data){
                var result = JSON.parse(data);
                var item = result.item;
                var searchResult = '';

                for (let index = 0; index < item.length; ++index) {
                    var image_url = '{{ asset("images/") }}/products/'+item[index].product_code+'/'+item[index].image;
                    searchResult += '' +
                        '<li class="bc-sf-search-suggestion-item bc-sf-search-suggestion-item-product ui-menu-item" aria-label="Products: '+ item[index].product_name +'">' +
                            '<a href="/product-detail/'+ item[index].id +'/'+ item[index].product_name.replace(/ /g,"_") +'" id="ui-id-25" tabindex="-1" class="ui-menu-item-wrapper">' +
                                '<div class="bc-sf-search-suggestion-left">' +
                                '<img src="'+image_url+'">'+
                            '</div>'+
                            '<div class="bc-sf-search-suggestion-right">'+
                                '<div class="bc-sf-search-suggestion-product-title">'+ item[index].product_name +'</div>'+
                            '</div>'+
                        '</a>'+
                    '</li>';
                }

                if(item.length == 0) {
                    searchResult += '' +
                        '<li class="bc-sf-search-suggestion-item ui-menu-item" >' +
                            '<span class="m-5">Search not found!</span>'+
                        '</li>';
                }

                $('#item').html(searchResult);
                $('#total_result').html('View All ' + result.total_result + ' Products');
                $('#total_result').attr('href', "/search-result/"+ search_query);
            }
        });
    };

    $('.Search__Close').on("click", function() {
        $('.bc-sf-search-suggestion-popover').hide();
        $('#ui-id-1').hide();

    });

    window.onload = function(){
            document.onclick = function(e){
            if(e.target.id !== '#ui-id-1' ){
                $('.bc-sf-search-suggestion-popover').hide();
                $('#ui-id-1').hide();
            }
        };
    };
</script>
@stack('scripts')
