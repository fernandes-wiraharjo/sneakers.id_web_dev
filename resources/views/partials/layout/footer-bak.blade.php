<div id="shopify-section-footer" class="shopify-section shopify-section--footer">
    <footer id="section-footer" class="Footer" role="contentinfo">
        <div class="Container">
            <div class="Footer__Inner">
                <div class="Footer__Block Footer__Block--text">
                    <h2 class="Footer__Title Heading u-h6">Contact Us</h2>
                    <div class="Footer__Content Rte">
                        @if (isset($footer->phone_number_1))
                            <p><strong>Hotline:</strong>
                                {{ $footer->phone_number_1 ?? '' }}{{ isset($footer->phone_number_2) ? ' / ' . ($footer->phone_number_2 ?? '') : '' }}
                            </p>
                        @endif
                        <p></p>
                        @if (isset($footer->email))
                            <p><strong>E-mail:</strong> {{ $footer->email ?? '' }}</p>
                        @endif
                        @if (isset($footer->address))
                            <p><strong>Address:</strong> {{ $footer->address ?? '' }}</p>
                        @endif
                        @if (isset($footer->wa))
                            <p><strong>Whatsapp:</strong> {{ $footer->wa ?? '' }}</p>
                        @endif
                        @if (isset($footer->line))
                            <p><strong>Line:</strong> {{ $footer->line ?? '' }}</p>
                        @endif
                    </div>
                    <ul class="Footer__Social HorizontalList HorizontalList--spacingLoose">
                        @if (isset($footer->social_media))
                            @foreach ($footer->social_media as $item)
                                <li class="HorizontalList__Item">
                                    <a href="{{ $item->social_link ?? '' }}" class="Link Link--primary" target="_blank"
                                        rel="noopener" aria-label="{{ $item->social_name ?? '' }}">
                                        <span class="Icon-Wrapper--clickable" style="width: 2rem !important;">
                                            <i class="fa fa-{{ $item->social_icon ?? 'circle' }}"
                                                aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="Footer__Block Footer__Block--links">
                    <h2 class="Footer__Title Heading u-h6">HELP</h2>
                    <ul class="Linklist">
                        <li class="Linklist__Item">
                            <a href="{{ route('faq') }}" class="Link Link--primary">FAQ</a>
                        </li>

                        <li class="Linklist__Item">
                            <a href="{{ $footer->maps ?? '' }}" class="Link Link--primary">
                                OUR STORE
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="Footer__Block Footer__Block--newsletter">
                    <h2 class="Footer__Title Heading u-h6">
                        <a href="{{ route('about-us') }}" class="Link Link--primary">About us</a>
                    </h2>
                    <div class="Footer__Content Rte">
                        <p>{{ $footer->about ?? '' }}</p>
                    </div>
                </div>
            </div>

            <div class="Footer__Aside">
                <div class="Footer__Block Footer__Block--text">
                    <a href="/" class="Footer__StoreName Heading u-h7 Link Link--secondary">© Sneakers.id
                        {{ date('Y') }}</a>
                </div>
                <div class="Footer__Copyright">
                    <a href="/" class="Footer__StoreName Heading u-h7 Link Link--secondary">Developed by : </a>
                    <br>
                    <span class="Footer__StoreName Heading u-h8 Link Link--secondary"
                        style="padding-block-start: 10px">Fernandes Wiraharjo - 089693670282 -
                        fernandeswiraharjo@gmail.com </span>
                    <br>
                    <span class="Footer__StoreName Heading u-h8 Link Link--secondary"
                        style="padding-block-start: 10px">Aldy Satria Gumilar - 089636022489 - aldy.satria07@gmail.com
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="bc-sf-search-suggestion-wrapper " style="top: 187.504px; left: 91px; width: 90%;">
    <div class="bc-sf-search-suggestion-popover" data-direction="left" style="top: -20px; left: 20px;display: none;">
    </div>
    <ul id="ui-id-1" tabindex="0"
        class="ui-menu ui-widget ui-widget-content ui-autocomplete bc-sf-search-suggestion ui-front"
        style="width: 100%; top: 0px; left: -40px;display: none;" data-search-box="#bc-sf-search-box-0">
        <li class="bc-sf-search-suggestion-header-product bc-sf-search-suggestion-header ui-menu-item"
            aria-label="Products">Products</li>
        <li id="item" data-group="products" aria-label="Products"></li>
        <li class="bc-sf-search-suggestion-header-view-all bc-sf-search-suggestion-header ui-menu-item"
            aria-label="View All"><a href="#" tabindex="-1" class="ui-menu-item-wrapper" id="total_result"></a></li>
    </ul>
</div>
{{-- @livewireScripts --}}
