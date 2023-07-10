<div id="step2" style="display: {{ $currentStep != 2 ? 'none' : '' }}">
    <div class="I_61l">
        <div class="tAyc6">
            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1z _1fragem2g">
                    <section aria-label="Review" class="_1fragem15 _1fragemaf">
                        <div role="table" aria-label="Review your information"
                            class="Z8Nx4 lT5DX">
                            <div role="row" class="NSCO_">
                                <div class="Qk5zF">
                                    <div role="cell" class="w3cHO"><span
                                            class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Contact</span>
                                    </div>
                                    <div role="cell" class="nkp8r"><bdo dir="ltr"
                                            class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $shippingEmail }}</bdo>
                                    </div>
                                </div>
                                <div role="cell">
                                    <a href="#"aria-label="Change contact information" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam" wire:click="back(1)>
                                        <span class="_19gi7yt0 _19gi7ytc _1fragem1i">Change</span>
                                    </a>
                                </div>
                            </div>
                            <div role="row" class="NSCO_">
                                <div class="Qk5zF">
                                    <div role="cell" class="w3cHO">
                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Ship
                                            to
                                        </span>
                                    </div>
                                    <div role="cell" class="nkp8r">
                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                            <address class="_19gi7yt0 _19gi7yte _1fragem1j">
                                                {{  $shippingAddress }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div role="cell">
                                    <a href="#"
                                        aria-label="Change shipping address"
                                        class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam" wire:click="back(1)"">
                                        <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                            Change
                                        </span></a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <main id="checkout-main">
                        <form action="" method="POST" novalidate="" id="Form12"
                            class="_1fragem16">
                            <div class="_1fragemaf">
                                <div>
                                    <div class="VheJw">
                                        <div class="s_qAq">
                                            <section aria-label="Shipping method"
                                                class="_1fragem15 _1fragemaf">
                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                        <h2 id="step-section-primary-header"
                                                            tabindex="-1"
                                                            class="n8k95w1 _1fragemaf n8k95w3">
                                                            Shipping method</h2>
                                                    </div>
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                                        <fieldset id="shipping_methods">
                                                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                                                <legend>Choose a shipping method</legend>
                                                            </div>
                                                            @foreach($shippingCourier as $courierVendor)
                                                                <div style="padding: 10px 0px;">
                                                                    {{ strtoupper($courierVendor['code']) }}
                                                                </div>
                                                                <div class="Wo4qW m5ItP NDMe9 NdTJE PuVf0">
                                                                    @foreach($courierVendor['costs'] as $serviceCourier)
                                                                    <div class="B4zH6">
                                                                        <label class="yL8c2 D1RJr">
                                                                            <div class="hEGyz">
                                                                                <div class="_1fragemaf">
                                                                                    <input type="radio" name="shipping_methods" class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe" value="{{intval($serviceCourier['cost'][0]['value'])}}" wire:click="updateShippingCost({{ intval($serviceCourier['cost'][0]['value']) }}, '{{ strtoupper($courierVendor['code']) }}', '{{ $serviceCourier['service'] }}', '{{ $serviceCourier['cost'][0]['etd'] }}', '{{ $total }}')" >
                                                                                </div>
                                                                                <div class="f5aCe">
                                                                                    <div>
                                                                                        <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j">
                                                                                            {{ strtoupper($courierVendor['code']) }} {{ $serviceCourier['service'] }} ({{ $serviceCourier['cost'][0]['etd'] }} Days)
                                                                                        </p>
                                                                                    </div>
                                                                                    <div>
                                                                                        <span translate="yes" class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">
                                                                                            Rp {{ rupiah_format(intval($serviceCourier['cost'][0]['value'])) }}
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach

                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="oQEAZ WD4IV">
                                            <div>
                                                <a href="#" class="QT4by rqC98 hodFu VDIfJ j6D1f janiy" wire:click="shippingStepSubmit">
                                                    <span class="AjwsM">Continue to payment</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="QT4by eVFmT j6D1f janiy adBMs" wire:click="back(1)">
                                                    <span class="AjwsM">
                                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                                                <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wuh a8x1wuf a8x1wum">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 14 14"
                                                                        focusable="false"
                                                                        aria-hidden="true"
                                                                        class="a8x1wuo _1fragem15 _1fragem34 _1fragem9q _1fragem9p">
                                                                        <path
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1">
                                                                        </path>
                                                                    </svg>
                                                                </span>
                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Return to information</span>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                <button type="submit" tabindex="-1" aria-hidden="true">
                                    Continue to payment
                                </button>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
