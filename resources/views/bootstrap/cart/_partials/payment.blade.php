<div id="step3" style="display: {{ $currentStep != 3 ? 'none' : '' }}">
    <div class="card">
        <div class="card-body">
            {{-- Review Section --}}
            <section class="mb-4">
                <h5 class="mb-3">Review your information</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 150px;">Contact</td>
                                <td>{{ $shippingEmail }}</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-link btn-sm p-0" wire:click="back(1)">Change</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Ship to</td>
                                <td>
                                    <address class="mb-0">{{ $shippingAddress }}</address>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-link btn-sm p-0" wire:click="back(1)">Change</a>
                                </td>
                            </tr>
                            @if($selectedCourier != [])
                                <tr>
                                    <td class="text-muted">Method</td>
                                    <td>
                                        {{ $selectedCourier['courier'] }} {{ $selectedCourier['service'] }}
                                        @if($selectedCourier['etd'])
                                            ({{ $selectedCourier['etd'] }} Days)
                                        @else
                                            (2-3 Days)
                                        @endif
                                        ({{ number_format($shippingWeight / 1000, 2) }} Kg)
                                        <span class="fw-bold">{{ rupiah_format(intval($selectedCourier['cost']), true) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-link btn-sm p-0" wire:click="back(2)">Change</a>
                                    </td>
                                </tr>
                            @endif
                            @if($note != '')
                                <tr>
                                    <td class="text-muted">Notes</td>
                                    <td>{{ $note }}</td>
                                    <td></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Payment Section --}}
            <section>
                <form action="" method="POST" novalidate="" id="Form13">
                    <h5 class="mb-2">Payment</h5>
                    <p class="text-muted small mb-4">All transactions are secure and encrypted.</p>

                    @if(!empty($voucherData) && !$voucherEligible)
                        <div class="card border-danger bg-danger bg-opacity-10 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <span class="iconify text-danger fs-3 flex-shrink-0" data-icon="material-symbols:error-outline"></span>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-danger mb-1">
                                            Promo {{ $voucherData['code'] ?? '' }} cannot be used
                                        </div>
                                        <p class="mb-2 small text-danger">{{ $voucherIneligibleMessage }}</p>
                                        <p class="small text-muted mb-3">Remove this promo to continue and choose a payment method.</p>
                                        <button type="button" class="btn btn-sm btn-danger" wire:click="removeVoucher">
                                            Remove promo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <fieldset>
                        <legend class="fs-6 fw-semibold mb-3">Choose a payment method</legend>
                        <div class="form-check mb-3 border rounded {{ !$voucherEligible ? 'bg-light text-muted' : '' }}" style="padding: 1rem 1rem 1rem 2.5rem;">
                            <input
                                type="radio"
                                id="payment-midtrans"
                                name="payment_method"
                                class="form-check-input"
                                wire:click="setSelectedPaymentGateway('midtrans')"
                                @if(!$voucherEligible) disabled @endif
                                @if($selectedPaymentGateway === 'midtrans' && $voucherEligible) checked @endif>
                            <label class="form-check-label w-100 {{ !$voucherEligible ? 'opacity-50' : '' }}" for="payment-midtrans">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Payments via Midtrans</strong>
                                        <div class="mt-2">
                                            <img src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/a682f971fb8ae9f2351a.svg" alt="" height="24" class="me-2">
                                            <img src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/426070b796cc82a1ece8.svg" alt="" height="24" class="me-2">
                                            <img src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/5e3b05b68f3d31b87e84.svg" alt="" height="24" class="me-2">
                                            <img src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/868b2986ebd3f77ba8ab.svg" alt="" height="24" class="me-2">
                                            <span class="text-muted small">and more…</span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div>
                            <a href="#" class="btn btn-outline-secondary" wire:click="back(2)">
                                <span class="iconify me-2" data-icon="material-symbols:arrow-back"></span>
                                Return to shipping
                            </a>
                        </div>
                        <div>
                            @if(!$voucherEligible)
                                <div class="alert alert-danger mb-0 py-2 px-3">
                                    <small>Remove the promo to select a payment method</small>
                                </div>
                            @elseif($selectedPaymentGateway)
                                <button
                                    type="button"
                                    class="btn btn-dark"
                                    wire:click="paymentStepSubmit">
                                    Pay now
                                </button>
                            @else
                                <div class="alert alert-warning mb-0 py-2 px-3">
                                    <small>Select payment method</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

