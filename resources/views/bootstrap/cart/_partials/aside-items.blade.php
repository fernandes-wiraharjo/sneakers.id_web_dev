<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Order summary</h5>
    </div>
    <div class="card-body">
        <section class="mb-4">
            <h6 class="mb-3">Shopping cart</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($content)
                        @foreach ($content as $id => $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="position-relative me-2" style="width: 60px; height: 60px;">
                                        <img src="{{ $item->get('image') }}" alt="{{ $item->get('name') }}" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 10px;">
                                            {{ $item->get('quantity') }}
                                        </div>
                                    </div>
                                    <div>
                                        <p class="mb-0 small fw-semibold">{{ $item->get('name') }}</p>
                                        <div class="text-muted small">
                                            @if ($item->get('discount_price') != 0)
                                                {{ rupiah_format($item->get('discount_price')) }}
                                            @else
                                                {{ rupiah_format($item->get('retail_price')) }}
                                            @endif
                                        </div>
                                        <div class="text-muted small">Size : {{ $item->get('size') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $item->get('quantity') }} x</td>
                            <td>
                                @if ($item->get('discount_price') != 0)
                                    <span class="small">{{ rupiah_format($item->get('quantity') * $item->get('discount_price')) }}</span>
                                @else
                                    <span class="small">{{ rupiah_format($item->get('quantity') * $item->get('retail_price')) }}</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
        <hr>
        <section>
            <h6 class="mb-3">Cost summary</h6>
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span>{{ rupiah_format($total) }}</span>
            </div>
            @if($voucherData && $voucherDiscount > 0)
            <div class="d-flex justify-content-between mb-2 text-danger">
                <span>Discount ({{ $voucherData['code'] }})</span>
                <span>- {{ rupiah_format($voucherDiscount) }}</span>
            </div>
            @endif
            <div class="d-flex justify-content-between mb-2">
                <span>Shipping</span>
                <span>{{ rupiah_format(intval($shippingCost ?? 0)) }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong>{{ rupiah_format($total - ($voucherDiscount ?? 0) + intval($shippingCost ?? 0)) }}</strong>
            </div>
        </section>
    </div>
</div>

