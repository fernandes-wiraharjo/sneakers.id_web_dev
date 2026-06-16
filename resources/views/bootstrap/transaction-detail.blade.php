@extends('bootstrap.layout')

@section('title', 'Transaction Detail - SNEAKERS.ID')

@push('styles')
<style>
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    .status-paid {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .status-expired {
        background-color: #f8d7da;
        color: #842029;
    }
    .status-completed {
        background-color: #cfe2ff;
        color: #084298;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12 d-flex align-items-center mb-4">
            <a href="{{ route('customer.dashboard') }}" class="border bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3 p-2">
                <span class="iconify fs-3" data-icon="stash:arrow-left-duotone"></span>
            </a>
            <h1 class="fw-bold mb-0">Transaction Detail</h1>
        </div>
    </div>
    
    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
        <div>
            <h2 class="h4 mb-2">Order <strong>#{{ strtoupper($transaction->token) }}</strong></h2>
            <div class="mb-2">
                <span class="text-muted">Payment Status: </span>
                @if ($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                    <span class="status-badge status-pending">AWAITING PAYMENT</span>
                @elseif($transaction->status == 'SETTLED' || $transaction->status == 'PAID' || $transaction->status == 'SUCCESS')
                    <span class="status-badge status-paid">SUCCESS</span>
                @elseif($transaction->status == 'EXPIRED' || $transaction->status == 'CANCELLED' || $transaction->status == 'REFUNDED' || $transaction->status == 'FAILED')
                    <span class="status-badge status-expired">{{ $transaction->status }}</span>
                @elseif($transaction->status == 'COMPLETED')
                    <span class="status-badge status-completed">COMPLETED</span>
                @endif
            </div>
            <p class="text-muted small mb-0">
                Order placed on {{ date('d F Y h:iA', strtotime($transaction->created_at))}}
            </p>
        </div>
        
        @if($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
            <a href="{{ $transaction->snap_payment_url }}" id="btn-continue-payment" class="btn btn-primary">
                Continue Payment
            </a>
        @endif
        
        {{-- Review Button --}}
        @if($shipping && $shipping->shipping_waybill)
            <a href="{{ route('customer.transaction.review', $transaction->token) }}" class="btn btn-dark">
                Write Review
            </a>
        @endif
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">ORDER ITEMS</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>PRODUCT</th>
                                    <th class="text-center" style="width: 100px;">QUANTITY</th>
                                    <th class="text-end" style="width: 150px;">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <img 
                                                src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" 
                                                alt="{{ $item->detail->product->product_name }}"
                                                class="rounded"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1">{{ $item->detail->product->product_name }}</h6>
                                                <p class="text-muted small mb-1">Size: {{ $item->detail->size }}</p>
                                                <p class="mb-0 fw-semibold">{{ rupiah_format($item->price, true) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">{{ $item->quantity }}</td>
                                    <td class="text-end align-middle fw-bold">{{ rupiah_format($item->quantity * $item->price, true) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="2" class="text-end">
                                        <strong>Subtotal</strong> <br>
                                        @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                                            <span class="text-danger">Discount ({{ $transaction->voucher_code }})</span> <br>
                                        @endif
                                        <strong>Shipping</strong> <br>
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-end">
                                        <strong>{{ rupiah_format($transaction->sub_total, true) }}</strong> <br>
                                        @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                                            <span class="text-danger fw-bold">- {{ rupiah_format($transaction->voucher_discount, true) }}</span> <br>
                                        @endif
                                        <strong>{{ rupiah_format($shipping->shipping_cost, true) }}</strong> <br>
                                        <strong class="fs-5">{{ rupiah_format($transaction->grand_total, true) }}</strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header py-3 bg-dark text-white">
                    <h5 class="mb-0 fw-bold">SHIPPING ADDRESS</h5>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>{{ $destination->first_name ?? '-' }} {{ $destination->last_name ?? '-' }}</strong>
                    </p>
                    <p class="mb-2 text-muted">
                        {{ $destination->address ?? '-' }}
                    </p>
                    <p class="mb-2 text-muted small">
                        {{ $location['subdistrict'] ?? '-' }}<br>
                        {{ $location['district'] ?? '-' }}<br>
                        {{ $location['city'] ?? '-' }}<br>
                        {{ $location['province'] ?? '-' }}<br>
                        {{ $location['postal_code'] ?? '-' }}
                    </p>
                    <p class="mb-1 text-muted small">
                        <strong>Phone:</strong> {{ $destination->phone_number ?? '-' }}
                    </p>
                    <p class="mb-0 text-muted small">
                        <strong>Email:</strong> {{ $destination->email ?? '-' }}
                    </p>
                </div>
            </div>

            {{-- Shipping Information Card --}}
            @if($shipping)
                <div class="card">
                    <div class="card-header py-3 bg-dark text-white">
                        <h5 class="mb-0 fw-bold">SHIPPING INFORMATION</h5>
                    </div>
                    <div class="card-body">
                        @if($shipping->courier_code)
                            <div class="mb-3">
                                <p class="mb-1 text-muted small"><strong>Courier:</strong></p>
                                <p class="mb-0 fw-semibold">{{ strtoupper($shipping->courier_code) }} {{ $shipping->shipping_method ?? '' }}</p>
                            </div>
                        @endif

                        @if($shipping->shipping_waybill)
                            <div class="mb-3">
                                <p class="mb-1 text-muted small"><strong>AWB / Tracking Number:</strong></p>
                                <div class="d-flex align-items-center gap-2">
                                    <code class="flex-grow-1 p-2 bg-light rounded" id="awb-number">{{ $shipping->shipping_waybill }}</code>
                                    <button 
                                        type="button" 
                                        class="btn btn-sm btn-outline-secondary" 
                                        onclick="copyToClipboard('{{ $shipping->shipping_waybill }}', this)"
                                        title="Copy to clipboard">
                                        <span class="iconify" data-icon="material-symbols:content-copy"></span>
                                    </button>
                                </div>
                            </div>
                        @endif


                        {{-- Shipping Status --}}
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><strong>Shipping Status:</strong></p>
                            @if(!$shipping_waybill && $transaction->status == 'SUCCESS')
                                <span class="status-badge status-pending">AWAITING SHIPMENT</span>
                            @endif
                            @if($shipping_waybill && $transaction->status == 'SUCCESS')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCheckShipping">
                                    CEK RESI
                                </button>
                            @endif
                            @if ($shipping_waybill && $transaction->status == 'COMPLETED')
                                <span class="status-badge status-completed">DELIVERED</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Shipping Modal -->
<div class="modal fade" id="modalCheckShipping" tabindex="-1" aria-labelledby="modalCheckShippingLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <p class="mb-3"><strong>WAKTU DITERIMA:</strong> {{ $shipping_waybill['data']['delivery_status']['pod_date'] }} {{ $shipping_waybill['data']['delivery_status']['pod_time'] }}</p>
                    </div>
                    <hr>
                    <h6 class="mb-3">Shipping History</h6>
                    @foreach ($shipping_waybill['data']['manifest'] as $item)
                        <div class="mb-3 pb-3 border-bottom">
                            <p class="mb-1"><strong>{{ $item['manifest_description']}}</strong>: {{ $item['city_name'] }}</p>
                            <p class="mb-0 text-muted small">TANGGAL: {{ $item['manifest_date']}} {{ $item['manifest_time']}}</p>
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

@push('scripts')
<script>
    function copyToClipboard(text, button) {
        navigator.clipboard.writeText(text).then(function() {
            const icon = button.querySelector('.iconify');
            const originalIcon = icon.getAttribute('data-icon');
            icon.setAttribute('data-icon', 'material-symbols:check');
            button.classList.remove('btn-outline-secondary');
            button.classList.add('btn-success');
            
            setTimeout(function() {
                icon.setAttribute('data-icon', originalIcon);
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-secondary');
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            alert('Failed to copy to clipboard');
        });
    }
</script>
@endpush
@endsection
