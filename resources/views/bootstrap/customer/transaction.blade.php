@extends('bootstrap.layout')

@section('title', 'Order #' . strtoupper($transaction->token) . ' - SNEAKERS.ID')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center">
            @auth
                <a href="{{ route('customer.dashboard') }}" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                    <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
                </a>
            @else
                <a href="{{ route('store') }}" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                    <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
                </a>
            @endauth
            <h1 class="fw-bold mb-0">Order #{{ strtoupper($transaction->token) }}</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <div class="mb-2">
                                <span class="me-2">Payment Status:</span>
                                @if ($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                                    <span class="badge bg-warning text-dark">AWAITING PAYMENT</span>
                                @elseif($transaction->status == 'SETTLED' || $transaction->status == 'PAID' || $transaction->status == 'SUCCESS' || $transaction->status == 'COMPLETED')
                                    <span class="badge bg-success">
                                        @if($transaction->status == 'COMPLETED')
                                            COMPLETED
                                        @else
                                            SUCCESS
                                        @endif
                                    </span>
                                @elseif($transaction->status == 'EXPIRED' || $transaction->status == 'CANCELLED' || $transaction->status == 'REFUNDED')
                                    <span class="badge bg-danger">{{ $transaction->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $transaction->status }}</span>
                                @endif
                            </div>
                            <p class="text-muted mb-0">
                                Order placed on {{ date('d F Y h:iA', strtotime($transaction->created_at)) }}
                            </p>
                        </div>
                        <div>
                            @if($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                                <a href="{{ $transaction->snap_payment_url }}" id="btn-continue-payment" class="btn btn-dark" style="min-width: 250px;">Continue Payment</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">ORDER ITEMS</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th class="text-center" style="max-width: 100px;">QUANTITY</th>
                                    <th class="text-end" style="max-width: 150px;">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <div class="ratio ratio-1x1" style="width: 80px;">
                                                    <img src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" 
                                                         alt="{{ $item->detail->product->product_name }}" 
                                                         class="img-fluid rounded" 
                                                         style="object-fit: cover;">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-1 fw-semibold">{{ $item->detail->product->product_name }}</p>
                                                <p class="mb-1 text-muted small">Size: {{ $item->detail->size }}</p>
                                                <p class="mb-0 text-muted small">{{ rupiah_format($item->price) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">{{ $item->quantity }}</td>
                                    <td class="text-end align-middle">{{ rupiah_format($item->quantity * $item->price) }}</td>
                                </tr>
                                @endforeach
                                <tr class="border-top">
                                    <td colspan="2" class="text-end">
                                        <strong>Subtotal</strong><br>
                                        @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                                        <span class="text-danger">Discount ({{ $transaction->voucher_code }})</span><br>
                                        @endif
                                        <strong>Shipping</strong><br>
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-end">
                                        <strong>{{ rupiah_format($transaction->sub_total) }}</strong><br>
                                        @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                                        <span class="text-danger fw-semibold">- {{ rupiah_format($transaction->voucher_discount) }}</span><br>
                                        @endif
                                        <strong>{{ rupiah_format($shipping->shipping_cost) }}</strong><br>
                                        <strong>{{ rupiah_format($transaction->grand_total) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">SHIPPING ADDRESS</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>{{ $destination->first_name ?? '-' }} {{ $destination->last_name ?? '-' }}</strong>
                    </p>
                    <p class="mb-2">
                        {{ $destination->address ?? '-' }}
                    </p>
                    <p class="mb-2">
                        {{ $region->area ?? '-' }}<br>
                        {{ $region->subdistrict ?? '-' }}<br>
                        {{ $region->district ?? '-' }}<br>
                        {{ $region->province ?? '-' }}<br>
                        {{ $region->post_code ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <strong>Phone Number:</strong> {{ $destination->phone_number ?? '-' }}
                    </p>
                    <p class="mb-3">
                        <strong>Email:</strong> {{ $destination->email ?? '-' }}
                    </p>
                    
                    <hr>
                    
                    <div class="mt-3">
                        <h6 class="mb-3">Shipping Information</h6>
                        @if($shipping->courier_code || $shipping->shipping_method)
                            <p class="mb-2">
                                <strong>Courier:</strong> 
                                @if($shipping->shipping_method)
                                    {{ strtoupper($shipping->courier_code ?? '') }} - {{ $shipping->shipping_method }}
                                @else
                                    {{ strtoupper($shipping->courier_code ?? '-') }}
                                @endif
                            </p>
                        @endif
                        @if($shipping->shipping_waybill)
                            <div class="mb-3">
                                <label class="form-label mb-2"><strong>AWB / Tracking Number:</strong></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="trackingNumber" value="{{ $shipping->shipping_waybill }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="copyTrackingBtn" title="Copy to clipboard">
                                        <span class="iconify" data-icon="mdi:content-copy"></span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        
                        @if($shipping->shipping_waybill)
                            <div class="mt-3">
                                <label class="form-label mb-2"><strong>Delivery Status:</strong></label>
                                <div class="d-flex flex-column gap-2">
                                    @if($shipping_waybill && $transaction->status == 'SUCCESS')
                                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalCheckShipping" style="min-width: 150px;">CEK RESI</button>
                                    @endif

                                    @if ($shipping_waybill && $transaction->status == 'COMPLETED')
                                        <div class="alert alert-success mb-0">
                                            <strong>DELIVERED</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipping Modal -->
<div class="modal fade" id="modalCheckShipping" tabindex="-1" aria-labelledby="modalCheckShippingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCheckShippingLabel">Check Shipping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (!$shipping_waybill)
                    <div class="alert alert-warning">
                        <strong>AWAITING SHIPMENT</strong>
                    </div>
                @elseif ($shipping_waybill && $shipping_waybill['meta']['code'] == 200)
                    <div class="mb-3">
                        <p class="mb-1"><strong>STATUS:</strong> {{ $shipping_waybill['data']['delivery_status']['status'] }}</p>
                        <p class="mb-1"><strong>PENERIMA:</strong> {{ $shipping_waybill['data']['delivery_status']['pod_receiver'] }}</p>
                        <p class="mb-0"><strong>WAKTU DITERIMA:</strong> {{ $shipping_waybill['data']['delivery_status']['pod_date'] }} {{ $shipping_waybill['data']['delivery_status']['pod_time'] }}</p>
                    </div>
                    <hr>
                    <h6 class="mb-3">Shipping History</h6>
                    @foreach ($shipping_waybill['data']['manifest'] as $item)
                        <div class="mb-3 pb-3 border-bottom">
                            <p class="mb-1"><strong>{{ $item['manifest_description'] }}</strong>: {{ $item['city_name'] }}</p>
                            <p class="mb-0 text-muted small">TANGGAL: {{ $item['manifest_date'] }} {{ $item['manifest_time'] }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">
                        {{ $shipping_waybill['meta']['message'] }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyBtn = document.getElementById('copyTrackingBtn');
        const trackingInput = document.getElementById('trackingNumber');
        
        if (copyBtn && trackingInput) {
            copyBtn.addEventListener('click', function() {
                trackingInput.select();
                trackingInput.setSelectionRange(0, 99999); // For mobile devices
                
                try {
                    document.execCommand('copy');
                    // Update button to show success
                    const originalHTML = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<span class="iconify" data-icon="mdi:check"></span>';
                    copyBtn.classList.add('btn-success');
                    copyBtn.classList.remove('btn-outline-secondary');
                    
                    setTimeout(function() {
                        copyBtn.innerHTML = originalHTML;
                        copyBtn.classList.remove('btn-success');
                        copyBtn.classList.add('btn-outline-secondary');
                    }, 2000);
                } catch (err) {
                    // Fallback for modern browsers
                    navigator.clipboard.writeText(trackingInput.value).then(function() {
                        const originalHTML = copyBtn.innerHTML;
                        copyBtn.innerHTML = '<span class="iconify" data-icon="mdi:check"></span>';
                        copyBtn.classList.add('btn-success');
                        copyBtn.classList.remove('btn-outline-secondary');
                        
                        setTimeout(function() {
                            copyBtn.innerHTML = originalHTML;
                            copyBtn.classList.remove('btn-success');
                            copyBtn.classList.add('btn-outline-secondary');
                        }, 2000);
                    }).catch(function(err) {
                        console.error('Failed to copy: ', err);
                    });
                }
            });
        }
    });
</script>
@endpush

