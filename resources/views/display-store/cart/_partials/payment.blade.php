<div id="step3" style="display: {{ $currentStep != 3 ? 'none' : '' }}">
    <div class="I_61l">
        <div class="tAyc6">
            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1z _1fragem2g">
                    <section aria-label="Review" class="_1fragem15 _1fragemaf">
                        <div role="table" aria-label="Review your information"
                            class="Z8Nx4 lT5DX">
                            <div role="row" class="NSCO_">
                                <div class="Qk5zF">
                                    <div role="cell" class="w3cHO">
                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Contact</span>
                                    </div>
                                    <div role="cell" class="nkp8r">
                                        <bdo dir="ltr" class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $shippingEmail }}</bdo>
                                    </div>
                                </div>
                                <div role="cell">
                                    <a href="#" wire:click="back(1)" aria-label="Change contact information" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam">
                                        <span class="_19gi7yt0 _19gi7ytc _1fragem1i">Change</span>
                                    </a>
                                </div>
                            </div>
                            <div role="row" class="NSCO_">
                                <div class="Qk5zF">
                                    <div role="cell" class="w3cHO">
                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Ship to</span>
                                    </div>
                                    <div role="cell" class="nkp8r">
                                        <div
                                            class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                                            <address class="_19gi7yt0 _19gi7yte _1fragem1j">
                                                {{  $shippingAddress }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                                <div role="cell">
                                    <a href="#" aria-label="Change shipping address" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam" wire:click="back(1)">
                                        <span class="_19gi7yt0 _19gi7ytc _1fragem1i">Change</span>
                                    </a>
                                </div>
                            </div>
                            @if($selectedCourier != [])
                            <div role="row" class="NSCO_">
                                <div class="Qk5zF">
                                    <div role="cell" class="w3cHO">
                                        <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Method</span>
                                    </div>
                                    <div role="cell" class="nkp8r">
                                        <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem24 _1fragem2l">
                                            <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem24 _1fragem2l">
                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j">
                                                    {{ $selectedCourier['courier'] }} {{ $selectedCourier['service'] }}
                                                    @if($selectedCourier['etd'])
                                                    ({{ $selectedCourier['etd'] }} Days)
                                                    @else
                                                    (2-3 Days)
                                                    @endif
                                                    ({{ number_format($shippingWeight / 1000, 2) }} Kg)
                                                    <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1">Rp {{ rupiah_format(intval($selectedCourier['cost'])) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="cell">
                                    <a href="#" aria-label="Change shipping method" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi2 _1fragemam" wire:click="back(2)">
                                        <span class="_19gi7yt0 _19gi7ytc _1fragem1i">Change</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                            @if($note != '')
                                <div role="row" class="NSCO_">
                                    <div class="Qk5zF">
                                        <div role="cell" class="w3cHO"><span
                                                class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt7">Notes</span>
                                        </div>
                                        <div role="cell" class="nkp8r"><bdo dir="ltr"
                                                class="_19gi7yt0 _19gi7yte _1fragem1j">{{ $note }}</bdo>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                    <main id="checkout-main">
                        <div>
                            <form action="" method="POST" novalidate="" id="Form13" class="_1fragem16">
                                <div class="_1fragemaf">
                                    <div class="VheJw">
                                        <div class="s_qAq">
                                            <section aria-label="Payment" class="_1fragem15 _1fragemaf">
                                                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                    <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                        <h2 id="step-section-primary-header"
                                                            tabindex="-1"
                                                            class="n8k95w1 _1fragemaf n8k95w3">
                                                            Payment</h2>
                                                        <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9sf">
                                                            All transactions are secure and
                                                            encrypted.</p>
                                                    </div>
                                                    <fieldset id="basic">
                                                        <div class="_1fragem15 _1fragemah _1fragemaf">
                                                            <legend>
                                                                Choose a payment method
                                                            </legend>
                                                        </div>
                                                        <div class="Wo4qW m5ItP NDMe9 NdTJE PuVf0">
                                                            <div class="B4zH6">
                                                                <label for="basic-Payments via Midtrans" class="yL8c2 D1RJr">
                                                                    <div class="hEGyz">
                                                                        <div class="_1fragemaf">
                                                                            <input type="radio" id="basic-Payments via Midtrans" name="basic" class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe">
                                                                        </div>
                                                                        <div class="f5aCe">
                                                                            <div>
                                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1">
                                                                                    Payments via Xendit
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                                <div class="wAAjh">
                                                                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                                                                        <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1r _1fragem28 _1fragem0 _1fragem4 _1fragem38">
                                                                                            <img alt=""
                                                                                                src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/a682f971fb8ae9f2351a.svg"
                                                                                                role="img"
                                                                                                width="38"
                                                                                                height="24"
                                                                                                class="_1tgdqw61 _1fragem46 _1fragem4b _1fragem4l _1fragem4g _1fragemat _1fragemap _1fragemb2 _1fragem33"><img
                                                                                                alt=""
                                                                                                src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/426070b796cc82a1ece8.svg"
                                                                                                role="img"
                                                                                                width="38"
                                                                                                height="24"
                                                                                                class="_1tgdqw61 _1fragem46 _1fragem4b _1fragem4l _1fragem4g _1fragemat _1fragemap _1fragemb2 _1fragem33"><img
                                                                                                alt=""
                                                                                                src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/5e3b05b68f3d31b87e84.svg"
                                                                                                role="img"
                                                                                                width="38"
                                                                                                height="24"
                                                                                                class="_1tgdqw61 _1fragem46 _1fragem4b _1fragem4l _1fragem4g _1fragemat _1fragemap _1fragemb2 _1fragem33"><img
                                                                                                alt=""
                                                                                                src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/868b2986ebd3f77ba8ab.svg"
                                                                                                role="img"
                                                                                                width="38"
                                                                                                height="24"
                                                                                                class="_1tgdqw61 _1fragem46 _1fragem4b _1fragem4l _1fragem4g _1fragemat _1fragemap _1fragemb2 _1fragem33"><span
                                                                                                class="_19gi7yt0 _19gi7ytc _1fragem1i _19gi7yt7">and
                                                                                                more…</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </section>
                                            {{-- <section aria-label="Billing address"
                                                class="_1fragem15 _1fragemaf">
                                                <div
                                                    class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1o _1fragem25">
                                                    <div
                                                        class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1r _1fragem28">
                                                        <h2
                                                            class="n8k95w1 _1fragemaf n8k95w3">
                                                            Billing address</h2>
                                                        <p
                                                            class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j _1x52f9sf">
                                                            Select the address that matches
                                                            your card or payment method.</p>
                                                    </div>
                                                    <fieldset id="billing_address_selector">
                                                        <div
                                                            class="_1fragem15 _1fragemah _1fragemaf">
                                                            <legend>Choose a billing address
                                                            </legend>
                                                        </div>
                                                        <div
                                                            class="Wo4qW m5ItP NDMe9 NdTJE PuVf0">
                                                            <div
                                                                class="B4zH6 Zb82w HKtYc OpmPd">
                                                                <label
                                                                    for="billing_address_selector-shipping_address"
                                                                    class="yL8c2 D1RJr">
                                                                    <div class="hEGyz">
                                                                        <div class="_1fragemaf">
                                                                            <input
                                                                                type="radio"
                                                                                id="billing_address_selector-shipping_address"
                                                                                name="billing_address_selector"
                                                                                class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe">
                                                                        </div><span
                                                                            class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1">Same
                                                                            as shipping
                                                                            address</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <div class="B4zH6"><label
                                                                    for="billing_address_selector-custom_billing_address"
                                                                    class="yL8c2 D1RJr">
                                                                    <div class="hEGyz">
                                                                        <div class="_1fragemaf">
                                                                            <input
                                                                                type="radio"
                                                                                id="billing_address_selector-custom_billing_address"
                                                                                name="billing_address_selector"
                                                                                class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe">
                                                                        </div><span
                                                                            class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1">Use
                                                                            a different
                                                                            billing
                                                                            address</span>
                                                                    </div>
                                                                </label>
                                                                <div id="billing_address_selector-custom_billing_address-collapsible"
                                                                    hidden=""
                                                                    class="_94sxtb1 _1fragem7q _1fragem7s _1fragemaf _1fragemav _1fragemaq _1fragemaz"
                                                                    style="height: 0px;">
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </section> --}}
                                        </div>
                                        <div class="oQEAZ WD4IV">
                                            <div>
                                                <a href="#" class="QT4by rqC98 hodFu VDIfJ j6D1f janiy"  wire:click="paymentStepSubmit">
                                                    <span class="AjwsM">Pay now</span>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#" class="QT4by eVFmT j6D1f janiy adBMs" wire:click="back(2)">
                                                    <span class="AjwsM">
                                                        <div class="_1fragem17 _1fragemaf _1fragem38">
                                                            <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem1t _1fragem2a _1fragem0 _1fragem4 _1fragem38">
                                                                <span class="_1fragem34 _1fragem10 _1fragem9q _1fragem9p _1fragem15 a8x1wuh a8x1wuf a8x1wum">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
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
                                                                <span class="_19gi7yt0 _19gi7yte _1fragem1j">Return to shipping</span>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="_1fragem16 _123qrzt1">
                                            <div class="_16s97g713"></div>
                                            <p class="_1x52f9s1 _1fragemaf _1x52f9sj _1fragem1i _1fragemaj _1x52f9sf">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="_1fragem15 _1fragemah _1fragemaf">
                                    <button type="submit" tabindex="-1" aria-hidden="true" wire:click="paymentStepSubmit">
                                        Pay now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>
