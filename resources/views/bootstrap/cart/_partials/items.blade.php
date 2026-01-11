<aside class="card mb-4">
    <div class="card-header">
        <button type="button" class="btn btn-link text-decoration-none w-100 text-start p-0" data-bs-toggle="collapse" data-bs-target="#disclosure_content" aria-expanded="true" aria-controls="disclosure_content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" focusable="false" aria-hidden="true" style="width: 20px; height: 20px;">
                        <circle cx="3.5" cy="11.9" r="0.3"></circle>
                        <circle cx="10.5" cy="11.9" r="0.3"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.502 11.898h-.004v.005h.004v-.005Zm7 0h-.005v.005h.005v-.005ZM1.4 2.1h.865a.7.7 0 0 1 .676.516l1.818 6.668a.7.7 0 0 0 .676.516h5.218a.7.7 0 0 0 .68-.53l1.05-4.2a.7.7 0 0 0-.68-.87H3.4"></path>
                    </svg>
                    <span class="fw-semibold">KLIK DISINI UNTUK DETAIL BELANJA ANDA</span>
                </div>
                <div>
                    <strong>{{ rupiah_format($total + intval($shippingCost ?? 0)) }}</strong>
                </div>
            </div>
        </button>
    </div>
    <div id="disclosure_content" class="collapse show">
        <div class="card-body">
            <section class="mb-4">
                <h5 class="mb-3">Shopping cart</h5>
                <div class="table-responsive">
                    <table class="table table-sm">
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
                                            <div class="position-absolute top-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 12px;">
                                                {{ $item->get('quantity') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1 fw-semibold">{{ $item->get('name') }}</p>
                                        <div class="text-muted small">
                                            @if ($item->get('discount_price') != 0)
                                                {{ rupiah_format($item->get('discount_price')) }}
                                            @else
                                                {{ rupiah_format($item->get('retail_price')) }}
                                            @endif
                                        </div>
                                        <div class="text-muted small">Size : {{ $item->get('size') }}</div>
                                    </td>
                                    <td class="text-center">{{ $item->get('quantity') }} x</td>
                                    <td>
                                        @if ($item->get('discount_price') != 0)
                                            <span>{{ rupiah_format($item->get('quantity') * $item->get('discount_price')) }}</span>
                                        @else
                                            <span>{{ rupiah_format($item->get('quantity') * $item->get('retail_price')) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
            <section>
                <h5 class="mb-3">Cost summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ rupiah_format($total) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span>{{ rupiah_format(intval($shippingCost ?? 0)) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong>
                    <strong>{{ rupiah_format($total + intval($shippingCost ?? 0)) }}</strong>
                </div>
            </section>
        </div>
    </div>
</aside>

