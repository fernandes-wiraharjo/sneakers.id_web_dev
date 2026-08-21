<aside class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Shopping cart</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Product image</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @if($content)
                        @foreach ($content as $id => $item)
                        <tr>
                            <td>
                                <div class="position-relative" style="width: 80px; height: 80px;">
                                    <img src="{{ $item->get('image') }}" alt="{{ $item->get('name') }}" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                    <span class="badge bg-dark position-absolute top-0 end-0 m-1">{{ $item->get('quantity') }}</span>
                                </div>
                            </td>
                            <td>
                                <p class="mb-1 fw-semibold">{{ $item->get('name') }}</p>
                                <div class="mb-1">
                                    @if ($item->get('discount_price') != 0 && $item->get('discount_price') < $item->get('retail_price'))
                                        <span class="text-danger fw-bold">{{ rupiah_format($item->get('discount_price'), true) }}</span>
                                    @else
                                        <span class="fw-semibold">{{ rupiah_format($item->get('retail_price'), true) }}</span>
                                    @endif
                                </div>
                                <div class="text-muted small">Size: {{ $item->get('size') }}</div>
                            </td>
                            <td class="text-center">
                                <span class="fw-semibold">{{ $item->get('quantity') }}</span>
                            </td>
                            <td class="text-end">
                                @if ($item->get('discount_price') != 0 && $item->get('discount_price') < $item->get('retail_price'))
                                    <span class="fw-bold">{{ rupiah_format($item->get('quantity') * $item->get('discount_price'), true) }}</span>
                                @else
                                    <span class="fw-bold">{{ rupiah_format($item->get('quantity') * $item->get('retail_price'), true) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        <hr>
        
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Subtotal</span>
            <span class="fw-semibold">{{ rupiah_format($total, true) }}</span>
        </div>
        
        @if(isset($voucherData) && isset($voucherDiscount) && $voucherDiscount > 0)
            <div class="d-flex justify-content-between mb-2 text-danger">
                <span>Discount ({{ $voucherData['code'] }})</span>
                <span class="fw-bold">- {{ rupiah_format($voucherDiscount, true) }}</span>
            </div>
        @endif
        
        <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Shipping</span>
            <span class="fw-semibold">{{ rupiah_format(intval($shippingCost ?? 0), true) }}</span>
        </div>
        
        <hr>
        
        <div class="d-flex justify-content-between">
            <span class="fw-bold fs-5">Total</span>
            <span class="fw-bold fs-5">{{ rupiah_format($total - ($voucherDiscount ?? 0) + intval($shippingCost ?? 0), true) }}</span>
        </div>
    </div>
</aside>

