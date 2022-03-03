<div id="shopify-section-footer" class="shopify-section shopify-section--footer">
    <footer id="section-footer" class="Footer" role="contentinfo">
        <div class="Container">
            <div class="Footer__Inner">
                <div class="Footer__Block Footer__Block--text">
                    <h2 class="Footer__Title Heading u-h6">Contact Us</h2>
                    <div class="Footer__Content Rte">
                        <p><strong>Hotline:</strong> {{ $footer->phone_number_1 ?? ''}}{{ isset($footer->phone_number_2) ? ' / '. ($footer->phone_number_2 ?? '') : ''}}</p>
                        <p></p>
                        <p><strong>E-mail: {{ $footer->email ?? ''}}</strong></p>
                        <p>Address : {{ $footer->address ?? ''}}</p>
                    </div>
                    <ul class="Footer__Social HorizontalList HorizontalList--spacingLoose">
                        @if(isset($footer->social_media))
                            @foreach ($footer->social_media as $item)
                                <li class="HorizontalList__Item">
                                    <a href="{{ $item->social_link ?? '' }}" class="Link Link--primary" target="_blank" rel="noopener" aria-label="{{ $item->social_name ?? '' }}">
                                        <span class="Icon-Wrapper--clickable" style="width: 2rem !important;">
                                            {{ $item->social_name ?? '' }}
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
                            <a href="/pages/terms-and-condition" class="Link Link--primary">TERMS AND CONDITION</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/refund-policy" class="Link Link--primary">REFUND POLICY</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="{{ route('faq') }}" class="Link Link--primary">FAQ</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="/pages/business-address" class="Link Link--primary">BUSINESS ADDRESS</a>
                        </li>
                        <li class="Linklist__Item">
                            <a href="{{ $footer->maps ?? ''}}"
                                class="Link Link--primary">
                                STORE LOCATOR
                            </a>
                        </li>
                        {{-- <li class="Linklist__Item">
                            <a href="/pages/staycool-satisfaction-guaranteed" class="Link Link--primary">SATISFACTION GUARANTEED</a>
                        </li> --}}
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
                <div class="Footer__Copyright">
                    <a href="/" class="Footer__StoreName Heading u-h7 Link Link--secondary">© Sneakers.id</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@livewireScripts
