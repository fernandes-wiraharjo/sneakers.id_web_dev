<aside class="I3DjT aADa7 fiOsL WrWRL">
    <div class="_1fragemah">
        <h2 class="n8k95w1 _1fragemaf n8k95w3">Order summary</h2>
    </div>
    <div class="RTcqB">
        <div class="I_61l">
            <div class="tAyc6">
                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1w _1fragem2d">
                        <section class="_1fragem15 _1fragemaf">
                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                <h3 id="ResourceList0" class="n8k95w1 _1fragemaf n8k95w4">
                                    Shopping cart</h3>
                            </div>
                            <div role="table" aria-labelledby="ResourceList0"
                                class="_6zbcq55 _1fragem17 _1fragem1d _6zbcq58 _6zbcq56">
                                <div role="row" class="_6zbcq51f _1fragem17 _1fragem4 _1fragem34 _6zbcq51d">
                                    <div role="columnheader" class="_6zbcq51g">
                                        <div class="_1fragem15 _1fragemah _1fragemaf">Product
                                            image</div>
                                    </div>
                                    <div role="columnheader" class="_6zbcq51g">
                                        <div class="_1fragem15 _1fragemah _1fragemaf">
                                            Description</div>
                                    </div>
                                    <div role="columnheader" class="_6zbcq51g">
                                        <div class="_1fragem15 _1fragemah _1fragemaf">Quantity
                                        </div>
                                    </div>
                                    <div role="columnheader" class="_6zbcq51g">
                                        <div class="_1fragem15 _1fragemah _1fragemaf">Price
                                        </div>
                                    </div>
                                </div>
                                @if($content)
                                @foreach ($content as $id => $item)
                                <div role="row" class="_6zbcq526 _1fragem17 _1fragem10 _6zbcq52d">
                                    <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                        <div class="_1fragem15 _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragemaf _16s97g7r _16s97g7t _16s97g7v TOZIs"
                                            style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                            <div class="_1h3po421 _1h3po423 _1fragemaf" style="--_1h3po420: 1;">
                                                <picture>
                                                    <source media="(min-width: 0px)"
                                                        srcset="{{ $item->get('image') }} 1x, {{ $item->get('image') }} 2x, {{ $item->get('image') }} 4x">
                                                    <img src="{{ $item->get('image') }}" alt="ZUMA"
                                                        class="_1h3po424 _1fragem15 _1fragem9q _1fragem3k _1fragem3h _1fragem3n _1fragem3e _1fragem48 _1fragem4d _1fragem4n _1fragem4i _1fragem5b _1fragem56 _1fragem5g _1fragem51 _1fragem9t">
                                                </picture>
                                            </div>
                                            <div aria-hidden="true"
                                                class="_1fragem17 _1fragem1d _1fragem49 _1fragem4e _1fragem4o _1fragem4j _1fragem4 _1fragem36 _1fragem8q _1fragem8u _1fragem89 _1fragem9b _1fragemad _16s97g7t _16s97g7v _16s97g7x _16s97g7h _16s97g7j _16s97g7l _16s97g7n AT21L"
                                                style="
                                                --_16s97g7s: 21px;
                                                --_16s97g7u: 33px;
                                                padding-top: 5px;
                                                /* --_16s97g7s: 2.1rem;
                                                --_16s97g7u: 2.1rem; */
                                                --_16s97g7w: translateX(calc(25% * var(--x-global-transform-direction-modifier))) translateY(-50%);
                                                --_16s97g7g: 0rem;
                                                --_16s97g7i: auto;
                                                --_16s97g7k: auto;
                                                --_16s97g7m: 0rem;
                                                "
                                                >
                                                <div class="_1fragem15 _1fragemaf s17WO">
                                                    <p
                                                        class="_1x52f9s1 _1fragemaf _1x52f9sj _1fragem1i _1x52f9s2">
                                                        {{ $item->get('quantity') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="cell"
                                        class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _1fragem1g">
                                        <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9s2">
                                            {{ $item->get('name') }}</p>
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
                                    <div role="cell"
                                        class="_6zbcq53y _1fragem17 _1fragem1d _1fragem36 _6zbcq53w">
                                        <div class="_1fragem15 _1fragemah _1fragemaf">
                                            <span class="_19gi7yt0 _19gi7yte _1fragem1j">{{
                                                $item->get('quantity') }}
                                                <div aria-hidden="true" class="_1fragem15 _1fragemaf"> x
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <div role="cell" class="_6zbcq53y _1fragem17 _1fragem1d _1fragem38">
                                        <div class="_1fragem17 _1fragem1d _1fragem5 _1fragem36 _1fragemaf _16s97g7r _16s97g7t _16s97g7v bua0H"
                                            style="--_16s97g7q: 6.4rem; --_16s97g7s: 6.4rem; --_16s97g7u: 6.4rem;">
                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a _1fragem3b">
                                                @if ($item->get('discount_price') != 0)
                                                <span translate="yes"
                                                    class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format($item->get('quantity') * $item->get('discount_price')) }}</span>
                                                @else
                                                <span translate="yes"class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{ rupiah_format($item->get('quantity') * $item->get('retail_price')) }}</span>
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
                    <hr>
                    <section class="_1fragem15 _1fragemaf">
                        <div class="_1fragem15 _1fragemah _1fragemaf">
                            <h3 id="MoneyLine-Heading0" class="n8k95w1 _1fragemaf n8k95w4">
                                Cost summary</h3>
                        </div>
                        <div role="table" aria-labelledby="MoneyLine-Heading0" class="nfgb6p0">
                            <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                <div role="cell" class="_1qy6ue69"><span
                                        class="_19gi7yt0 _19gi7yte _1fragem1j">Subtotal</span>
                                </div>
                                <div role="cell" class="_1qy6ue6a"><span translate="yes"
                                        class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp {{ rupiah_format($total) }}</span>
                                </div>
                            </div>
                            <div role="row" class="_1qy6ue61 _1fragem1b _1qy6ue68">
                                <div role="cell" class="_1qy6ue69">
                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                        <div
                                            class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1r _1fragem28 _1fragem0 _1fragem4 _1fragem38">
                                            <span class="_19gi7yt0 _19gi7yte _1fragem1j">Shipping</span>
                                        </div>
                                    </div>
                                </div>
                                <div role="cell" class="_1qy6ue6a"><span translate="yes"
                                        class="_19gi7yt0 _19gi7yte _1fragem1j notranslate">Rp {{  rupiah_format(intval($shippingCost)) }}</span>
                                </div>
                            </div>
                            <div role="row" class="_1x41w3p1 _1fragem1b _1fragem4 _1x41w3p8">
                                <div role="cell" class="_1x41w3p9"><span
                                        class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1">Total</span>
                                </div>
                                <div role="cell" class="_1x41w3pa">
                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                        <div
                                            class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem3 _1fragem38">
                                            <abbr translate="yes"
                                                class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7 notranslate _19gi7ytq _1fragemal">IDR</abbr><strong
                                                translate="yes"
                                                class="_19gi7yt0 _19gi7yti _1fragem1l _19gi7yt1 notranslate">Rp {{ rupiah_format($total + intval($shippingCost)) }}</strong>
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
</aside>
