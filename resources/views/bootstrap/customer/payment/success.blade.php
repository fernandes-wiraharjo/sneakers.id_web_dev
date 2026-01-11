@extends('bootstrap.layout')

@section('title', 'Payment Success')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                <h4 class="alert-heading">Order Confirmed!</h4>
                <p>Order ID: <strong>#{{ strtoupper($response->order_id ?? '') }}</strong></p>
                <p>Thank you {{ $destination->first_name ?? '' }} {{ $destination->last_name ?? '' }}!</p>
                <hr>
                <p class="mb-0">We'll process your order soon. You'll receive an email when your order is completed.</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Order Details</h5>
            <hr>
            <p><strong>Contact:</strong><br>{{ $destination->email ?? '' }}</p>
            
            <p><strong>Shipping Address:</strong><br>
                {{ $destination->first_name ?? '' }} {{ $destination->last_name ?? '' }}<br>
                {{ $destination->phone_number ?? '' }}<br>
                {{ $destination->address ?? '' }}<br>
                {{ $destination->region->area ?? '' }}<br>
                {{ $destination->region->subdistrict ?? '' }}<br>
                {{ $destination->region->district ?? '' }}<br>
                {{ $destination->region->province ?? '' }}, {{ $destination->region->post_code ?? '' }}
            </p>
        </div>

        <div class="col-md-6">
            <h5>Payment Information</h5>
            <hr>
            <p><strong>Payment Method:</strong><br>{{ str_replace('_', ' ', $response->payment_type ?? '') }}</p>
            <p><strong>Amount:</strong><br>{{ rupiah_format(intval($response->gross_amount ?? 0)) }}</p>
            
            <p><strong>Shipping Method:</strong><br>
                {{ $shipping->shipping_method ?? '' }} - {{ rupiah_format(intval($shipping->shipping_cost ?? 0)) }}
            </p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h5>Shopping Cart</h5>
            <hr>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($items)
                            @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" 
                                             alt="{{ $item->detail->product->product_name }}" 
                                             style="width: 80px; height: 80px; object-fit: cover;" 
                                             class="me-3">
                                        <div>
                                            <strong>{{ $item->detail->product->product_name }}</strong><br>
                                            <small>Size: {{ $item->detail->size }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ rupiah_format($item->price) }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h5>Cost Summary</h5>
            <hr>
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span>{{ rupiah_format(intval($transaction->sub_total ?? 0)) }}</span>
            </div>
            @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
            <div class="d-flex justify-content-between mb-2 text-danger">
                <span>Discount ({{ $transaction->voucher_code }}):</span>
                <span>- {{ rupiah_format(intval($transaction->voucher_discount)) }}</span>
            </div>
            @endif
            <div class="d-flex justify-content-between mb-2">
                <span>Shipping {{ $shipping->shipping_method ?? '' }}:</span>
                <span>{{ rupiah_format(intval($shipping->shipping_cost ?? 0)) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total:</strong>
                <strong>{{ rupiah_format(intval($transaction->grand_total ?? 0)) }}</strong>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <p>Need help? <strong><a href="mailto:help@sneakers.id">Contact us</a></strong></p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="/" class="btn btn-outline-dark me-2">Continue Shopping</a>
            <a href="{{ route('customer.transaction.detail', $transaction->token) }}" class="btn btn-dark">Go to Transaction Status</a>
        </div>
    </div>
</div>
@endsection

