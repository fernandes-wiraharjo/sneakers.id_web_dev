<aside class="_PiNS CiOA7">
    <button type="button" aria-controls="disclosure_content" class="go8Cy" aria-pressed="true"
        aria-expanded="true">
        <span class="iibJ6">
            <div class="_1fragem17 _1fragemaf _1fragem38">
                <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                    <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p a8x1wu4 _1fragem15 a8x1wui a8x1wuf a8x1wum">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false"
                            aria-hidden="true"
                            class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                            <circle cx="3.5" cy="11.9" r="0.3">
                            </circle>
                            <circle cx="10.5" cy="11.9" r="0.3">
                            </circle>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4">
                            </path>
                        </svg>
                    </span>
                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">
                        KLIK DISINI UNTUK DETAIL BELANJA ANDA
                        <div class="_1fragem19 _16s97g727 _16s97g71j"></div>
                        <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p a8x1wu4 a8x1wue _1fragem19 a8x1wug a8x1wum">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"
                                focusable="false" aria-hidden="true"
                                class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.9 5.6-4.653 4.653a.35.35 0 0 1-.495 0L2.1 5.6">
                                </path>
                            </svg>
                        </span>
                    </span>
                </div>
            </div>
            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                <p translate="yes" class="_1x52f9s1 _1fragemaf _1x52f9sp _1fragem1l _1x52f9s2 notranslate">
                    Rp {{ rupiah_format($total + intval($shippingCost)) }}</p>
            </div>
        </span>
    </button>
    <div id="disclosure_content" class="_94sxtb1 _1fragem7q _1fragem7s _1fragemaf _1fragemav _1fragemaq _1fragemaz" style="height: auto; overflow: visible;">
        <div>
            <div class="awQ1u PK5O_">
                <div class="dnZK3">
                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                            <section class="_1fragem15 _1fragemaf">
                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                    <h2 id="ResourceList10" class="n8k95w1 _1fragemaf n8k95w3">Shopping
                                        cart</h2>
                                </div>
                                <div role="table" aria-labelledby="ResourceList10" class="_6zbcq55 _1fragem17 _1fragem1d _6zbcq58 _6zbcq56">
                                    <div role="row" class="_6zbcq51f _1fragem17 _1fragem4 _1fragem34 _6zbcq51d">
                                        <div role="columnheader" class="_6zbcq51g">
                                            <div class="_1fragem15 _1fragemah _1fragemaf">Product image
                                            </div>
                                        </div>
                                        <div role="columnheader" class="_6zbcq51g">
                                            <div class="_1fragem15 _1fragemah _1fragemaf">Description
                                            </div>
                                        </div>
                                        <div role="columnheader" class="_6zbcq51g">
                                            <div class="_1fragem15 _1fragemah _1fragemaf">Quantity</div>
                                        </div>
                                        <div role="columnheader" class="_6zbcq51g">
                                            <div class="_1fragem15 _1fragemah _1fragemaf">Price</div>
                                        </div>
                                    </div>
                                    @if($content)
                                        @foreach ($content as $id => $item)
                                        <div role="row" class="_6zbcq526 _1fragem17 _1fragem10 _6zbcq52d">
                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                <div class="_1fragem15 _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragemaf _16s97g7r _16s97g7t _16s97g7v TOZIs" style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                    <div class="_1h3po421 _1h3po423 _1fragemaf" style="--_1h3po420: 1;">
                                                        <picture>
                                                            <source media="(min-width: 0px)" srcset="{{ $item->get('image') }} 1x, {{ $item->get('image') }} 2x, {{ $item->get('image') }} 4x">
                                                            <img src="{{ $item->get('image') }}" alt="ZUMA" class="_1h3po424 _1fragem15 _1fragem9q _1fragem3k _1fragem3h _1fragem3n _1fragem3e _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragem5b _1fragem56 _1fragem5g _1fragem51 _1fragem9t">
                                                        </picture>
                                                    </div>
                                                    <div aria-hidden="true" class="_1fragem17 _1fragem1d _1fragem49 _1fragem4e _1fragem4o _1fragem4j _1fragem4 _1fragem36 _1fragem8q _1fragem8u _1fragem89 _1fragem9b _1fragemad _16s97g7t _16s97g7v _16s97g7x _16s97g7h _16s97g7j _16s97g7l _16s97g7n AT21L" style="--_16s97g7s: 2.1rem; --_16s97g7u: 2.1rem; --_16s97g7w: translateX(calc(25% * var(--x-global-transform-direction-modifier))) translateY(-50%); --_16s97g7g: 0rem; --_16s97g7i: auto; --_16s97g7k: auto; --_16s97g7m: 0rem;">
                                                        <div class="_1fragem15 _1fragemaf s17WO">
                                                            <p class="_1x52f9s1 _1fragemaf _1x52f9sj _1fragem1i _1x52f9s2">
                                                                {{ $item->get('quantity') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _1fragem1g">
                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9s2">
                                                    {{ $item->get('name') }}
                                                </p>
                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                    @if ($item->get('discount_price') != 0)
                                                        Rp {{ rupiah_format($item->get('discount_price')) }}
                                                    @else
                                                        Rp {{ rupiah_format($item->get('retail_price')) }}
                                                    @endif
                                                </div>
                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                    Size : {{ $item->get('size') }}
                                                </div>
                                            </div>
                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _6zbcq53w">
                                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $item->get('quantity') }}
                                                        <div aria-hidden="true" class="_1fragem15 _1fragemaf"> x
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                            <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                                <div class="_1fragem17 _1fragem1d _1fragem5 _1fragem36 _1fragemaf _16s97g7r _16s97g7t _16s97g7v bua0H" style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                                                        @if ($item->get('discount_price') != 0)
                                                        <span translate="yes"
                                                            class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format($item->get('quantity') * $item->get('discount_price'))
                                                            }}</span>
                                                        @else
                                                        <span translate="yes"
                                                            class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format($item->get('quantity') * $item->get('retail_price'))
                                                            }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </section>
                        </div>
                        <section class="_1fragem15 _1fragemaf">
                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                <h2 id="MoneyLine-Heading10" class="n8k95w1 _1fragemaf n8k95w3">Cost
                                    summary</h2>
                            </div>
                            <div role="table" aria-labelledby="MoneyLine-Heading10" class="nfgb6p0">
                                <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                    <div role="cell" class="_1qy6ue69">
                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j">Subtotal</span>
                                    </div>
                                    <div role="cell" class="_1qy6ue6a">
                                        <span translate="yes" class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp
                                            {{ rupiah_format($total) }}
                                        </span>
                                    </div>
                                </div>
                                <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                    <div role="cell" class="_1qy6ue69">
                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1r _1fragem28 _1fragem0 _1fragem4 _1fragem38">
                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Shipping</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="cell" class="_1qy6ue6a">
                                        <span translate="yes" class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format(intval($shippingCost)) }}</span>
                                    </div>
                                </div>
                                <div role="row" class="_1x41w3p1 _1fragem1b _1fragem4 _1x41w3p8">
                                    <div role="cell" class="_1x41w3p9">
                                        <span class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1">Total</span>
                                    </div>
                                    <div role="cell" class="_1x41w3pa">
                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem3 _1fragem38">
                                                <abbr translate="yes" class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7 notranslate _19gi7ytq _1fragemal">IDR</abbr>
                                                <strong translate="yes" class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1 notranslate">Rp {{ rupiah_format($total + intval($shippingCost)) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
