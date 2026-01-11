<div id="step3" style="display: {{ $currentStep != 3 ? 'none' : '' }}">
    <div class="card">
        <div class="card-body">
            <section aria-label="Review" class="mb-4">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td><strong>Contact</strong></td>
                                <td>{{ $shippingEmail }}</td>
                                <td class="text-end">
                                    <a href="#" wire:click="back(1)" class="text-decoration-none">Change</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Ship to</strong></td>
                                <td>{{ $shippingAddress }}</td>
                                <td class="text-end">
                                    <a href="#" wire:click="back(1)" class="text-decoration-none">Change</a>
                                </td>
                            </tr>
                            @if($selectedCourier != [])
                            <tr>
                                <td><strong>Method</strong></td>
                                <td>
                                    {{ $selectedCourier['courier'] }} {{ $selectedCourier['service'] }}
                                    @if($selectedCourier['etd'])
                                        ({{ $selectedCourier['etd'] }} Days)
                                    @else
                                        (2-3 Days)
                                    @endif
                                    ({{ number_format($shippingWeight / 1000, 2) }} Kg)
                                    <span class="fw-semibold">{{ rupiah_format(intval($selectedCourier['cost'])) }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" wire:click="back(2)" class="text-decoration-none">Change</a>
                                </td>
                            </tr>
                            @endif
                            @if($note != '')
                            <tr>
                                <td><strong>Notes</strong></td>
                                <td>{{ $note }}</td>
                                <td></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>

            <form action="" method="POST" novalidate="" id="Form13">
                <section aria-label="Payment" class="mb-4">
                    <h2 id="step-section-primary-header" class="mb-2">Payment</h2>
                    <p class="text-muted mb-3">All transactions are secure and encrypted.</p>
                    <fieldset id="basic">
                        <legend class="mb-3">Choose a payment method</legend>
                        <div class="mb-3 p-3 border rounded">
                            <div class="form-check">
                                <input type="radio" id="basic-Payments via Midtrans" wire:click="setSelectedPaymentGateway('midtrans')" name="basic" class="form-check-input">
                                <label for="basic-Payments via Midtrans" class="form-check-label w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-semibold">Payments via Midtrans</span>
                                        </div>
                                        <div>
                                            <img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/a682f971fb8ae9f2351a.svg" width="38" height="24" class="me-1">
                                            <img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/426070b796cc82a1ece8.svg" width="38" height="24" class="me-1">
                                            <img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/5e3b05b68f3d31b87e84.svg" width="38" height="24" class="me-1">
                                            <img alt="" src="https://cdn.shopify.com/shopifycloud/checkout-web/assets/868b2986ebd3f77ba8ab.svg" width="38" height="24" class="me-1">
                                            <span class="text-muted small">and more…</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </section>

                <div class="d-flex gap-2 justify-content-between mt-4">
                    <a href="#" class="btn btn-outline-dark" wire:click="back(2)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" style="width: 16px; height: 16px; display: inline-block; margin-right: 8px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                        </svg>
                        Return to shipping
                    </a>
                    @if($selectedPaymentGateway)
                        <button type="button" class="btn btn-dark" wire:click="paymentStepSubmit">
                            Pay now
                        </button>
                    @else
                        <div class="alert alert-warning mb-0">
                            <span>Select payment method</span>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

