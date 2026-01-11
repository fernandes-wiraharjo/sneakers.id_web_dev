@php
    // Group couriers by code
    $groupedCouriers = collect($shippingCourier)->groupBy('code');
@endphp

<div id="step2" style="display: {{ $currentStep != 2 ? 'none' : '' }}">
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
                            <tr>
                                <td><strong>Weight Total</strong></td>
                                <td>{{ number_format($shippingWeight / 1000, 2) }} Kg</td>
                                <td></td>
                            </tr>
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

            <form action="" method="POST" novalidate="" id="Form12">
                <section aria-label="Shipping method" class="mb-4">
                    <h2 id="step-section-primary-header" class="mb-3">Shipping method</h2>
                    @if($shippingCourier != [])
                        <fieldset id="shipping_methods">
                            <legend class="mb-3">Choose a shipping method</legend>
                            @foreach($groupedCouriers as $courierCode => $courierServices)
                                <div class="mb-2">
                                    <strong>{{ strtoupper($courierCode) }}</strong>
                                </div>
                                @foreach($courierServices as $courierVendor)
                                    <div class="mb-3 p-3 border rounded">
                                        <div class="form-check">
                                            <input type="radio" name="shipping_methods" class="form-check-input" id="shipping_{{ $courierCode }}_{{ $courierVendor['service'] }}" value="{{intval($courierVendor['cost'])}}" wire:click="updateShippingCost({{ intval($courierVendor['cost']) }}, '{{ strtoupper($courierVendor['code']) }}', '{{ $courierVendor['service'] }}', '{{ $courierVendor['etd'] }}', '{{ $total }}')">
                                            <label class="form-check-label w-100" for="shipping_{{ $courierCode }}_{{ $courierVendor['service'] }}">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="mb-0 fw-semibold">
                                                            {{ $courierVendor['service'] }}
                                                            @if($courierVendor['etd'])
                                                                ({{ $courierVendor['etd'] }} Days)
                                                            @else
                                                                (2-3 Days)
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <span class="fw-semibold">{{ rupiah_format(intval($courierVendor['cost'])) }}</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </fieldset>
                    @else
                        <div class="alert alert-warning">
                            Mohon coba kembali
                        </div>
                    @endif
                </section>

                <div class="d-flex gap-2 justify-content-between mt-4">
                    <a href="#" class="btn btn-outline-dark" wire:click="back(1)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" style="width: 16px; height: 16px; display: inline-block; margin-right: 8px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.4 11.9 3.748 7.248a.35.35 0 0 1 0-.495L8.4 2.1"></path>
                        </svg>
                        Return to information
                    </a>
                    @if ($selectedCourier)
                        <button type="button" class="btn btn-dark" wire:click="shippingStepSubmit">
                            Continue to payment
                        </button>
                    @else
                        <div class="alert alert-warning mb-0">
                            <span>Select shipping method</span>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

