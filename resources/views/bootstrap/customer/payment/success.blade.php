@extends('bootstrap.layout')

@section('title', 'Payment Success - SNEAKERS.ID')

@push('styles')
<style>
    .success-icon {
        width: 80px;
        height: 80px;
        background-color: #d1e7dd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    .success-icon svg {
        width: 50px;
        height: 50px;
        color: #0f5132;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            {{-- Success Message --}}
            <div class="text-center mb-5">
                <div class="success-icon">
                    <span class="iconify" data-icon="material-symbols:check-circle" style="font-size: 50px; color: #0f5132;"></span>
                </div>
                <h1 class="fw-bold mb-3">Your Order is Confirmed</h1>
                <p class="text-muted fs-5 mb-2">Thank you, {{ $destination->first_name }} {{ $destination->last_name }}!</p>
                <p class="text-muted">We'll process your order soon. You'll receive an email when your order is completed.</p>
                <div class="mt-4">
                    <h3 class="fw-bold">Order #{{ strtoupper($response->order_id) }}</h3>
                </div>
            </div>

            <div class="row g-4">
                {{-- Left Column: Order Details --}}
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0 fw-bold">ORDER DETAILS</h5>
                        </div>
                        <div class="card-body">
                            {{-- Contact Information --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Contact</h6>
                                <p class="mb-0 text-muted">{{ $destination->email }}</p>
                            </div>

                            {{-- Shipping Address --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Shipping Address</h6>
                                <p class="mb-1">{{ $destination->first_name }} {{ $destination->last_name }}</p>
                                <p class="mb-1 text-muted">{{ $destination->phone_number }}</p>
                                <p class="mb-1 text-muted">{{ $destination->address }}</p>
                                @php $loc = shipping_location($destination); @endphp
                                <p class="mb-1 text-muted">
                                    {{ $loc['subdistrict'] }}, {{ $loc['district'] }}, {{ $loc['city'] }}, {{ $loc['province'] }} {{ $loc['postal_code'] }}
                                </p>
                            </div>

                            {{-- Payment Method --}}
                            <div class="mb-4">
                                <h6 class="fw-bold mb-2">Payment Method</h6>
                                <p class="mb-1">{{ str_replace('_', ' ', ucwords($response->payment_type)) }}</p>
                                <p class="mb-0 fw-bold">{{ rupiah_format(intval($response->gross_amount), true) }}</p>
                            </div>

                            {{-- Shipping Method --}}
                            <div>
                                <h6 class="fw-bold mb-2">Shipping Method</h6>
                                <p class="mb-0">{{ $shipping->shipping_method }} - {{ rupiah_format(intval($shipping->shipping_cost), true) }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Help Section --}}
                    <div class="mt-4">
                        <p class="mb-0">
                            Need help? <strong><a href="mailto:help@sneakers.id" class="text-decoration-none">Contact us</a></strong>
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('store') }}" class="btn btn-outline-dark">
                            Continue Shopping
                        </a>
                        <a href="{{ route('customer.transaction.detail', $transaction->token) }}" class="btn btn-dark">
                            <span class="iconify me-2" data-icon="material-symbols:arrow-back"></span>
                            Go to Transaction Status
                        </a>
                    </div>
                </div>

                {{-- Right Column: Order Summary --}}
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0 fw-bold">ORDER SUMMARY</h5>
                        </div>
                        <div class="card-body">
                            {{-- Order Items --}}
                            <h6 class="fw-semibold mb-3">Shopping cart</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <img src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" alt="{{ $item->detail->product->product_name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div>
                                                        <p class="mb-0 small fw-semibold">{{ $item->detail->product->product_name }}</p>
                                                        <p class="mb-0 small text-muted">Size: {{ $item->detail->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="small">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="small fw-semibold">{{ rupiah_format($item->price, true) }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <hr>
                            
                            {{-- Cost Summary --}}
                            <h6 class="fw-semibold mb-3">Cost summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small">Subtotal</span>
                                <span class="small fw-semibold">{{ rupiah_format($transaction->sub_total, true) }}</span>
                            </div>
                            
                            @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                                <div class="d-flex justify-content-between mb-2 text-danger">
                                    <span class="small">Discount ({{ $transaction->voucher_code }})</span>
                                    <span class="small fw-bold">- {{ rupiah_format($transaction->voucher_discount, true) }}</span>
                                </div>
                            @endif
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small">Shipping</span>
                                <span class="small fw-semibold">{{ rupiah_format(intval($shipping->shipping_cost), true) }}</span>
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold">{{ rupiah_format($transaction->grand_total, true) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

