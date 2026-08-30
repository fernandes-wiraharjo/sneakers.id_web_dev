<div>
    @if ($content->count() > 0)
        <form action="{{route('customer.checkout.order', $session_id)}}" method="POST" novalidate="">
            @csrf
            <input type="hidden" name="attributes[collection_mobile_items_per_row]" value="">
            <input type="hidden" name="attributes[collection_desktop_items_per_row]" value="">
            <input type="hidden" name="total" value="{{ $total }}">

            {{-- Cart Items --}}
            <div class="row mb-4">
                <div class="col-12">
                    {{-- Desktop Header --}}
                    <div class="row d-none d-md-flex border-bottom pb-2 mb-3">
                        <div class="col-md-6">
                            <span class="text-muted small fw-semibold">Product</span>
                        </div>
                        <div class="col-md-2 text-center">
                            <span class="text-muted small fw-semibold">Quantity</span>
                        </div>
                        <div class="col-md-2 text-end">
                            <span class="text-muted small fw-semibold">Price</span>
                        </div>
                        <div class="col-md-2 text-end">
                            <span class="text-muted small fw-semibold">Total</span>
                        </div>
                    </div>

                    @if($hasUnavailableItems)
                    <div class="alert alert-danger mb-4" role="alert">
                        One or more items are no longer in stock. Remove them to apply a voucher or checkout.
                    </div>
                    @endif

                    {{-- Cart Items List --}}
                    @foreach ($content as $id => $item)
                    @php $lineUnavailable = !empty($unavailableLines[$id]); @endphp
                    <div class="row border-bottom pb-3 mb-3 align-items-center {{ $lineUnavailable ? 'border border-danger rounded-3 bg-danger bg-opacity-10 px-2 py-2' : '' }}">
                        {{-- Product Image and Info --}}
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div class="d-flex gap-3">
                                <img src="{{ $item->get('image') }}" alt="{{ $item->get('name') }}" class="cart-item-image">
                                <div class="flex-grow-1">
                                    @if($lineUnavailable)
                                        <div class="text-danger small fw-bold mb-2">This product is no longer available (out of stock).</div>
                                    @endif
                                    <h5 class="mb-2">
                                        <a href="{{ $item->get('url') }}" class="text-dark text-decoration-none">{{ $item->get('name') }}</a>
                                    </h5>
                                    <div class="mb-2">
                                        @if($item->get('discount_price') != 0 && $item->get('discount_price') < $item->get('retail_price'))
                                            <span class="text-muted text-decoration-line-through me-2">{{ rupiah_format($item->get('retail_price'), true) }}</span>
                                            <span class="fw-bold text-danger">{{ rupiah_format($item->get('discount_price'), true) }}</span>
                                        @else
                                            <span class="fw-semibold">{{ rupiah_format($item->get('retail_price'), true) }}</span>
                                        @endif
                                    </div>
                                    <div class="text-muted small">
                                        <span>Size: {{ $item->get('size') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Quantity Selector --}}
                        <div class="col-6 col-md-2 mb-3 mb-md-0">
                            <div class="d-flex justify-content-center justify-content-md-center">
                                <div class="quantity-selector">
                                    <button type="button" 
                                            class="quantity-btn" 
                                            wire:click="updateCartItem({{ $id }}, 'minus', {{ $item->get('quantity') }})"
                                            title="Decrease quantity"
                                            @if($lineUnavailable) disabled @endif>
                                        <span class="iconify" data-icon="mdi:minus" style="font-size: 16px;"></span>
                                    </button>
                                    <input type="text" 
                                           name="updates[]"
                                           class="form-control quantity-input" 
                                           value="{{ $item->get('quantity') }}"
                                           min="1"
                                           readonly>
                                    @isset($disabledPlus)
                                        @isset($disabledPlus[$id])
                                            <button type="button" 
                                                    class="quantity-btn" 
                                                    wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                    wire:disabled="{{ $disabledPlus[$id] ? 'true' : 'false'}}"
                                                    title="Increase quantity"
                                                    {{ $disabledPlus[$id] || $lineUnavailable ? 'disabled' : '' }}>
                                                <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                            </button>
                                        @else
                                            <button type="button" 
                                                    class="quantity-btn" 
                                                    wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                    title="Increase quantity"
                                                    {{ $lineUnavailable ? 'disabled' : '' }}>
                                                <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                            </button>
                                        @endisset
                                    @else
                                        <button type="button" 
                                                class="quantity-btn" 
                                                wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                title="Increase quantity"
                                                {{ $lineUnavailable ? 'disabled' : '' }}>
                                            <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                        </button>
                                    @endisset
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <button type="button" 
                                        class="btn btn-link text-danger p-0 small" 
                                        wire:click="removeFromCart({{ $id }})">
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- Unit Price --}}
                        <div class="col-6 col-md-2 text-end mb-3 mb-md-0 d-md-block d-none">
                            @if($item->get('discount_price') != 0 && $item->get('discount_price') < $item->get('retail_price'))
                                <span class="text-muted text-decoration-line-through d-block small">{{ rupiah_format($item->get('retail_price'), true) }}</span>
                                <span class="fw-semibold text-danger">{{ rupiah_format($item->get('discount_price'), true) }}</span>
                            @else
                                <span class="fw-semibold">{{ rupiah_format($item->get('retail_price'), true) }}</span>
                            @endif
                        </div>

                        {{-- Total Price --}}
                        <div class="col-6 col-md-2 text-end">
                            <span class="fw-bold">
                                @if($item->get('discount_price') != 0 && $item->get('discount_price') < $item->get('retail_price'))
                                    {{ rupiah_format($item->get('quantity') * $item->get('discount_price'), true) }}
                                @else
                                    {{ rupiah_format($item->get('quantity') * $item->get('retail_price'), true) }}
                                @endif
                            </span>
                        </div>

                        <input type="hidden" name="cart_item[{{ $id }}][id]" value="{{ $id }}">
                        <input type="hidden" name="cart_item[{{ $id }}][product_code]" value="{{ $item->get('product_code') }}">
                        <input type="hidden" name="cart_item[{{ $id }}][quatity]" value="{{ $item->get('quantity') }}">
                    </div>
                    @endforeach
                    @livewire('product-quantity-modal', key('modal-checkout-1'))
                </div>
            </div>

            {{-- Footer Section --}}
            <div class="row">
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    {{-- Order Note Section --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <label for="cart-note" class="form-label fw-semibold mb-2">
                                {{ $note == '' ? 'Add Order Note' : 'Edit Order Note' }}
                            </label>
                            <textarea class="form-control" 
                                      wire:model.debounce.1000ms="note" 
                                      id="cart-note" 
                                      rows="4" 
                                      placeholder="How can we help you?">{{ $note }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                    {{-- Voucher Code Section --}}
                    <div class="card h-100">
                        <div class="card-body">
                            <label for="voucher_code" class="form-label fw-semibold mb-3">Have a voucher code?</label>
                            
                            {{-- Email field for guests only (authenticated users use their account email) --}}
                            @guest
                            <div class="mb-3">
                                <label for="guest_email" class="form-label small fw-semibold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" 
                                       wire:model.defer="guestEmail" 
                                       id="guest_email" 
                                       class="form-control" 
                                       placeholder="Enter your email address"
                                       {{ $voucherApplied || $hasUnavailableItems ? 'disabled' : '' }}>
                            </div>
                            @endguest
                            
                            <div class="input-group">
                                <input type="text" 
                                       wire:model.defer="voucherCode" 
                                       id="voucher_code" 
                                       class="form-control" 
                                       placeholder="Enter voucher code"
                                       {{ $voucherApplied || $hasUnavailableItems ? 'disabled' : '' }}>
                                @if(!$voucherApplied)
                                    <button type="button" 
                                            wire:click="applyVoucher" 
                                            wire:loading.attr="disabled"
                                            class="btn btn-dark"
                                            wire:target="applyVoucher"
                                            @if($hasUnavailableItems) disabled @endif>
                                        <span wire:loading.remove wire:target="applyVoucher">Check Voucher</span>
                                        <span wire:loading wire:target="applyVoucher">
                                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                            Checking...
                                        </span>
                                    </button>
                                @else
                                    <button type="button" 
                                            wire:click="removeVoucher" 
                                            class="btn btn-outline-danger">
                                        Remove
                                    </button>
                                @endif
                            </div>
                            @if($voucherMessage)
                                <div class="mt-2 small {{ $voucherApplied ? 'text-success' : 'text-danger' }}">
                                    {{ $voucherMessage }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Summary</h5>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-semibold">{{ rupiah_format($total, true) }}</span>
                            </div>

                            @if($voucherApplied && $discountAmount > 0)
                                <div class="d-flex justify-content-between mb-2 text-danger">
                                    <span>Discount:</span>
                                    <span class="fw-bold">- {{ rupiah_format($discountAmount, true) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total:</span>
                                    <span class="fw-bold fs-5">{{ rupiah_format($finalTotal, true) }}</span>
                                </div>
                            @endif

                            <p class="text-muted small mb-4">Ongkir dihitung saat checkout</p>
                            
                            <button type="submit" name="checkout" class="btn btn-dark w-100 btn-lg" @if($hasUnavailableItems) disabled @endif>
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-5">
            <div class="mb-4">
                <span class="iconify" data-icon="mdi:cart-outline" style="font-size: 80px; color: #dee2e6;"></span>
            </div>
            <h3 class="mb-3">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="/collections/all" class="btn btn-dark btn-lg">Continue Shopping</a>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('updateNote', () => {
                const textarea = document.getElementById('cart-note');
                Livewire.emit('updateNote', textarea.value);
            });
        });

        // Listen for quantity correction events
        window.addEventListener('quantity-corrected', event => {
            const sizeId = event.detail.size_id;
            const correctedQty = event.detail.quantity;
            
            const inputs = document.querySelectorAll(`input[data-size-id="${sizeId}"]`);
            inputs.forEach(input => {
                input.value = correctedQty;
            });
        });
    </script>
</div>

