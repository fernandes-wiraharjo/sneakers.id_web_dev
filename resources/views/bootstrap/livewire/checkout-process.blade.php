<div role="region" aria-labelledby="step-section-primary-header">
    <div class="row">
        {{-- Left Column: Checkout Steps --}}
        <div class="col-12 col-lg-7 mb-4 mb-lg-0">
            {{-- Breadcrumb Navigation --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('customer.cart') }}">Cart</a></li>
                    <li class="breadcrumb-item {{ $currentStep != 1 ? '' : 'active' }}">
                        @if ($currentStep != 1)
                            <a href="#step1" wire:click="back(1)">Information</a>
                        @else
                            <strong>Information</strong>
                        @endif
                    </li>
                    <li class="breadcrumb-item {{ $currentStep != 2 ? '' : 'active' }}">
                        @if ($currentStep != 2)
                            <a href="#step2" wire:click="back(2)">Shipping</a>
                        @else
                            <strong>Shipping</strong>
                        @endif
                    </li>
                    <li class="breadcrumb-item {{ $currentStep != 3 ? '' : 'active' }}">
                        @if ($currentStep != 3)
                            <a href="#step3" wire:click="back(3)">Payment</a>
                        @else
                            <strong>Payment</strong>
                        @endif
                    </li>
                </ol>
            </nav>

            {{-- Success Message --}}
            @if (!empty($successMessage))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $successMessage }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Checkout Steps --}}
            <div class="row">
                <div class="col-12">
                    <div>
                        {{-- Step 1: Information --}}
                        @include('bootstrap.cart._partials.information')

                        {{-- Step 2: Shipping --}}
                        @include('bootstrap.cart._partials.shipping')

                        {{-- Step 3: Payment --}}
                        @include('bootstrap.cart._partials.payment')

                        {{-- Step 4: Invoice (if needed) --}}
                        @include('bootstrap.cart._partials.invoice')
                    </div>
                </div>
            </div>

            {{-- Footer: Policy Links --}}
            <footer class="mt-4 pt-3 border-top">
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Refund policy
                    </button>
                    <span class="text-muted">|</span>
                    <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        Privacy policy
                    </button>
                    <span class="text-muted">|</span>
                    <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                        Terms of service
                    </button>
                </div>
            </footer>
        </div>

        {{-- Right Column: Order Summary --}}
        <div class="col-12 col-lg-5">
            @include('bootstrap.cart._partials.aside-items', [
                'content' => $content, 
                'total' => $total, 
                'shippingCost' => $shippingCost ?? 0, 
                'voucherData' => $voucherData ?? null, 
                'voucherDiscount' => $voucherDiscount ?? 0
            ])
        </div>
    </div>

    {{-- Policy Modals --}}
    @include('bootstrap.cart._partials.policy-modal')
</div>

