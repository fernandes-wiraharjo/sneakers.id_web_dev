@php
    // Group couriers by code
    $groupedCouriers = collect($shippingCourier)->groupBy('code');
@endphp

<div id="step2" style="display: {{ $currentStep != 2 ? 'none' : '' }}">
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
                            <tr>
                                <td class="text-muted">Weight Total</td>
                                <td>{{ number_format($shippingWeight / 1000, 2) }} Kg</td>
                                <td></td>
                            </tr>
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

            {{-- Shipping Method Section --}}
            <section>
                <form action="" method="POST" novalidate="" id="Form12">
                    <h5 class="mb-3">Shipping method</h5>
                    @if($shippingCourier != [])
                        <fieldset>
                            <legend class="visually-hidden">Choose a shipping method</legend>
                            @foreach($groupedCouriers as $courierCode => $courierServices)
                                <div class="mb-3">
                                    <h6 class="text-uppercase mb-2">{{ $courierCode }}</h6>
                                    @foreach($courierServices as $courierVendor)
                                        <div class="form-check mb-3 border rounded" style="padding: 1rem 1rem 1rem 2.5rem;">
                                            <input 
                                                type="radio" 
                                                name="shipping_methods" 
                                                class="form-check-input" 
                                                id="shipping_{{ $courierCode }}_{{ $loop->index }}"
                                                value="{{ intval($courierVendor['cost']) }}" 
                                                wire:click="updateShippingCost({{ intval($courierVendor['cost']) }}, '{{ strtoupper($courierVendor['code']) }}', '{{ $courierVendor['service'] }}', '{{ $courierVendor['etd'] }}', '{{ $total }}')">
                                            <label class="form-check-label w-100" for="shipping_{{ $courierCode }}_{{ $loop->index }}">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong>{{ $courierVendor['service'] }}</strong>
                                                        @if($courierVendor['etd'])
                                                            <span class="text-muted">({{ $courierVendor['etd'] }} Days)</span>
                                                        @else
                                                            <span class="text-muted">(2-3 Days)</span>
                                                        @endif
                                                    </div>
                                                    <div class="fw-bold">
                                                        {{ rupiah_format(intval($courierVendor['cost'])) }}
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </fieldset>
                    @else
                        <div class="alert alert-warning">
                            Mohon coba kembali
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <div>
                            <a href="#" class="btn btn-outline-secondary" wire:click="back(1)">
                                <span class="iconify me-2" data-icon="material-symbols:arrow-back"></span>
                                Return to information
                            </a>
                        </div>
                        <div>
                            @if ($selectedCourier)
                                <button 
                                    type="button"
                                    class="btn btn-dark"
                                    wire:click="shippingStepSubmit">
                                    Continue to payment
                                </button>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <small>Select shipping method</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

