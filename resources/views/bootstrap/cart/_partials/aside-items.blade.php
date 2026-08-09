<aside class="card mb-4">
    <div class="card-header py-3 bg-dark text-white">
        <h5 class="mb-0 fw-bold">ORDER SUMMARY</h5>
    </div>
    <div class="card-body">
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
                    @if($content)
                        @foreach ($content as $id => $item)
                        <tr>
                            <td>
                                <div class="d-flex gap-2">
                                    <img src="{{ $item->get('image') }}" alt="{{ $item->get('name') }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <p class="mb-0 small fw-semibold">{{ $item->get('name') }}</p>
                                        <p class="mb-0 small text-muted">Size: {{ $item->get('size') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="small">{{ $item->get('quantity') }}</span>
                            </td>
                            <td class="text-end">
                                @if ($item->get('discount_price') != 0)
                                    <span class="small fw-semibold">{{ rupiah_format($item->get('quantity') * $item->get('discount_price'), true) }}</span>
                                @else
                                    <span class="small fw-semibold">{{ rupiah_format($item->get('quantity') * $item->get('retail_price'), true) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        <hr>
        
        <h6 class="fw-semibold mb-3">Cost summary</h6>
        <div class="d-flex justify-content-between mb-2">
            <span class="small">Subtotal</span>
            <span class="small fw-semibold">{{ rupiah_format($total, true) }}</span>
        </div>
        
        @if(isset($voucherData) && !empty($voucherData) && empty($voucherEligible))
            <div class="d-flex justify-content-between mb-2 text-warning">
                <span class="small">Voucher {{ $voucherData['code'] }}</span>
                <span class="small">Not applicable</span>
            </div>
        @elseif(isset($voucherData) && isset($voucherDiscount) && $voucherDiscount > 0)
            <div class="d-flex justify-content-between mb-2 text-danger">
                <span class="small">Discount ({{ $voucherData['code'] }})</span>
                <span class="small fw-bold">- {{ rupiah_format($voucherDiscount, true) }}</span>
            </div>
        @endif
        
        <div class="d-flex justify-content-between mb-2">
            <span class="small">Shipping</span>
            <span class="small fw-semibold">{{ rupiah_format(intval($shippingCost ?? 0), true) }}</span>
        </div>
        
        <hr>
        
        <div class="d-flex justify-content-between">
            <span class="fw-bold">Total</span>
            <span class="fw-bold">{{ rupiah_format($total - ($voucherDiscount ?? 0) + intval($shippingCost ?? 0), true) }}</span>
        </div>
    </div>
</aside>

