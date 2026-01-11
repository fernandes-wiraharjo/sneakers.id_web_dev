<div role="region" aria-labelledby="step-section-primary-header">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Checkout</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="mt-4">
                {{-- Content --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
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

                @if (!empty($successMessage))
                <div class="alert alert-success">
                    {{ $successMessage }}
                </div>
                @endif

                <div class="row pt-3">
                    {{-- Step 1 --}}
                    @include('bootstrap.cart._partials.information')

                    {{-- Step 2 --}}
                    @include('bootstrap.cart._partials.shipping')

                    {{-- Step 3 --}}
                    @include('bootstrap.cart._partials.payment')

                    <footer role="contentinfo" class="mt-5">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#refundModal">
                                Refund policy
                            </button>
                            <button type="button" class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#privacyModal">
                                Privacy policy
                            </button>
                            <button type="button" class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#termsModal">
                                Terms of service
                            </button>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            @include('bootstrap.cart._partials.aside-items')
        </div>
    </div>

    @include('bootstrap.cart._partials.policy-modal')
</div>

