<html class="no-js" lang="en">
@include('partials.layout.header')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style>
    body {
        background-color: #eee;
    }

    main {
        padding-top: 10%;
        align-items: center;
        padding-left: 5%;
        padding-right: 5%;
        padding-bottom: 5%;
    }

    #pinBoot {
        /* margin-bottom: 100px; */
        position: relative;
        max-width: 100%;
        width: 100%;
        padding: 0;
    }

    img {
        width: 100%;
        max-width: 100%;
        height: auto;
    }

    .white-panel {
        position: absolute;
        background: white;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3);
        padding: 10px;
    }

    /*
stylize any heading tags withing white-panel below
*/

    .white-panel h1 {
        font-size: 1em;
    }

    .white-panel h1 a {
        color: #A92733;
    }

    .white-panel:hover {
        box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
        margin-top: -5px;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .modal {
        height: -webkit-fill-available;
        width: -webkit-fill-available;
        display: block;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .Modal {
        background-color: rgba(0, 0, 0, 0.322) !important;
        max-width: calc(100vw);
        max-height: calc(var(--window-height)) !important;
    }

    .modal-content {
        border: none;
        box-shadow: none !important;
        -webkit-box-shadow: none !important;
        background-color: unset !important;
    }

    .modal-body img {
        border-radius: 10px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-open {
        position: relative;
    }

    .close {
        color: white !important;
        opacity: unset !important;
    }

    .pagination-section {
        /* position: fixed; */
        display: block;
        text-align: center;
        /* margin-top: inherit; */
    }

    @media only screen and (max-width: 715px) {
        .content {
            padding-bottom: 0;
        }

        .pagination {
            position: unset;
            margin-top: 150px;
        }
    }

    .pagination {
        position: unset;
    }

</style>

<body class="prestige--v4 template-collection">
    @include('partials.layout.navbar')

    <main id="main" role="main">
        <div class="content">
            <section id="pinBoot">
                @foreach ($lookbook as $item)
                        <article class="white-panel">
                            <p>
                                <span>
                                    {{$item->look_book_title}}
                                </span>
                            </p>
                            <a  class="pop" href="#" data-id="{{$item->id}}">
                                <img id="imageresource{{$item->id}}" src="{{ getImage($item->look_book_image, 'lookbook')}}" alt="{{$item->look_book_title}}">
                            </a>
                        </article>
                @endforeach

            </section>
            <div class="pagination-section">
                {{$lookbook->links()}}
            </div>
        </div>

        @foreach ($lookbook as $item)
        <!-- Creates the bootstrap modal where the image will appear -->
        <div class="modal fade" id="imagemodal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <a class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </a>
                        <img src="" id="imagepreview{{$item->id}}">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </main>

    <script>
        $(document).ready(function() {
            $('#pinBoot').pinterest_grid({
                no_columns: 4,
                padding_x: 10,
                padding_y: 10,
                margin_bottom: 50,
                single_column_breakpoint: 700
            });
        });

        ;(function ($, window, document, undefined) {
            var pluginName = 'pinterest_grid',
                defaults = {
                    padding_x: 10,
                    padding_y: 10,
                    no_columns: 3,
                    margin_bottom: 50,
                    single_column_breakpoint: 700
                },
                columns,
                $article,
                article_width;

            function Plugin(element, options) {
                this.element = element;
                this.options = $.extend({}, defaults, options) ;
                this._defaults = defaults;
                this._name = pluginName;
                this.init();
            }

            Plugin.prototype.init = function () {
                var self = this,
                    resize_finish;

                $(window).resize(function() {
                    clearTimeout(resize_finish);
                    resize_finish = setTimeout( function () {
                        self.make_layout_change(self);
                    }, 11);
                });

                self.make_layout_change(self);

                setTimeout(function() {
                    $(window).resize();
                }, 500);
            };

            Plugin.prototype.calculate = function (single_column_mode) {
                var self = this,
                    tallest = 0,
                    row = 0,
                    $container = $(this.element),
                    container_width = $container.width();
                    $article = $(this.element).children();

                if(single_column_mode === true) {
                    article_width = $container.width() - self.options.padding_x;
                } else {
                    article_width = ($container.width() - self.options.padding_x * self.options.no_columns) / self.options.no_columns;
                }

                $article.each(function() {
                    $(this).css('width', article_width);
                });

                columns = self.options.no_columns;

                $article.each(function(index) {
                    var current_column,
                        left_out = 0,
                        top = 0,
                        $this = $(this),
                        prevAll = $this.prevAll(),
                        tallest = 0;

                    if(single_column_mode === false) {
                        current_column = (index % columns);
                    } else {
                        current_column = 0;
                    }

                    for(var t = 0; t < columns; t++) {
                        $this.removeClass('c'+t);
                    }

                    if(index % columns === 0) {
                        row++;
                    }

                    $this.addClass('c' + current_column);
                    $this.addClass('r' + row);

                    prevAll.each(function(index) {
                        if($(this).hasClass('c' + current_column)) {
                            top += $(this).outerHeight() + self.options.padding_y;
                        }
                    });

                    if(single_column_mode === true) {
                        left_out = 0;
                    } else {
                        left_out = (index % columns) * (article_width + self.options.padding_x);
                    }

                    $this.css({
                        'left': left_out,
                        'top' : top
                    });
                });

                this.tallest($container);
                $(window).resize();
            };

            Plugin.prototype.tallest = function (_container) {
                var column_heights = [],
                    largest = 0;

                for(var z = 0; z < columns; z++) {
                    var temp_height = 0;
                    _container.find('.c'+z).each(function() {
                        temp_height += $(this).outerHeight();
                    });
                    column_heights[z] = temp_height;
                }

                largest = Math.max.apply(Math, column_heights);
                _container.css('height', largest + (this.options.padding_y + this.options.margin_bottom));
            };

            Plugin.prototype.make_layout_change = function (_self) {
                if($(window).width() < _self.options.single_column_breakpoint) {
                    _self.calculate(true);
                } else {
                    _self.calculate(false);
                }
            };

            $.fn[pluginName] = function (options) {
                return this.each(function () {
                    if (!$.data(this, 'plugin_' + pluginName)) {
                        $.data(this, 'plugin_' + pluginName,
                        new Plugin(this, options));
                    }
                });
            }

        })(jQuery, window, document);

        $(".pop").on("click", function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $('#imagemodal'+id+' #imagepreview'+id).attr('src', $('#imageresource'+id).attr('src')); // here asign the image to the modal when the user click the enlarge link
            $('#imagemodal'+id).modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });
    </script>

    @include('partials.layout.footer')

    @include('partials.layout.script')
</body>

</html>
