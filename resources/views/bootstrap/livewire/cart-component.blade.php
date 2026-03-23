<div>
@if ($content->count() > 0)
    <div class="d-flex flex-column h-100">
        <!-- Cart Items (Scrollable) -->
        <div class="flex-grow-1 overflow-auto p-3">
            <input type="hidden" name="attributes[collection_mobile_items_per_row]" value="">
            <input type="hidden" name="attributes[collection_desktop_items_per_row]" value="">
            <input type="hidden" name="total" value="{{ $total }}">

            @foreach ($content as $id => $item)
                <input type="hidden" name="cart_item[{{ $id }}][id]" value="{{ $id }}">
                <input type="hidden" name="cart_item[{{ $id }}][product_code]" value="{{ $item->get('product_code') }}">
                <input type="hidden" name="cart_item[{{ $id }}][quatity]" value="{{ $item->get('quantity') }}">
                
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Product Image -->
                            <div class="col-4">
                                <a href="{{ $item->get('url') }}">
                                    <img src="{{ $item->get('image') }}" 
                                         alt="{{ $item->get('name') }}" 
                                         class="img-fluid rounded"
                                         style="width: 100%; height: auto; aspect-ratio: 1;">
                                </a>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="col-8">
                                <h6 class="card-title mb-2">
                                    <a href="{{ $item->get('url') }}" class="text-decoration-none text-dark">
                                        {{ $item->get('name') }}
                                    </a>
                                </h6>
                                
                                <!-- Price -->
                                <div class="mb-2">
                                    @if($item->get('discount_price') != 0)
                                        <div>
                                            <del class="text-muted small">{{ rupiah_format($item->get('retail_price'), true) }}</del>
                                        </div>
                                        <div class="fw-bold text-danger">
                                            {{ rupiah_format($item->get('discount_price'), true) }}
                                        </div>
                                    @else
                                        <div class="fw-bold">
                                            {{ rupiah_format($item->get('retail_price'), true) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Size -->
                                <div class="mb-2">
                                    <small class="text-muted">Size: <strong>{{ $item->get('size') }}</strong></small>
                                </div>
                                
                                <!-- Quantity Selector -->
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary btn-sm" 
                                                type="button"
                                                wire:click="updateCartItem({{ $id }}, 'minus', {{ $item->get('quantity') }})"
                                                style="width: 32px; padding: 0;">
                                            <span class="iconify" data-icon="mdi:minus" style="font-size: 16px;"></span>
                                        </button>
                                        <input type="text" 
                                               class="form-control form-control-sm text-center" 
                                               value="{{ $item->get('quantity') }}"
                                               readonly
                                               style="border-left: 0; border-right: 0;">
                                        @isset($disabledPlus)
                                            @isset($disabledPlus[$id])
                                                <button class="btn btn-outline-secondary btn-sm" 
                                                        type="button"
                                                        wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                        {{ $disabledPlus[$id] ? 'disabled' : '' }}
                                                        style="width: 32px; padding: 0; {{ $disabledPlus[$id] ? 'cursor: not-allowed; opacity: 0.5;' : '' }}">
                                                    <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                                </button>
                                            @else
                                                <button class="btn btn-outline-secondary btn-sm" 
                                                        type="button"
                                                        wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                        style="width: 32px; padding: 0;">
                                                    <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                                </button>
                                            @endisset
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    type="button"
                                                    wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                                    style="width: 32px; padding: 0;">
                                                <span class="iconify" data-icon="mdi:plus" style="font-size: 16px;"></span>
                                            </button>
                                        @endisset
                                    </div>
                                    
                                    <button class="btn btn-link text-danger btn-sm p-0 text-decoration-none" 
                                            type="button"
                                            wire:click="removeFromCart({{ $id }})">
                                        <small>Remove</small>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Cart Footer (Fixed at bottom) -->
        <div class="border-top p-3 bg-white">
            <!-- Order Note Toggle -->
            <div class="text-center mb-3">
                <button type="button" 
                        class="btn btn-link text-decoration-none text-dark fw-bold p-0" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#orderNoteCollapse" 
                        aria-expanded="false" 
                        aria-controls="orderNoteCollapse">
                    {{ $note == '' ? 'Add Order Note' : 'Edit Order Note' }}
                </button>
                <span class="mx-2">|</span>
                <button type="button" 
                        class="btn btn-link text-danger text-decoration-none p-0" 
                        wire:click="clearCart">
                    <small>Clear Cart</small>
                </button>
            </div>
            
            <!-- Order Note Collapse -->
            <div class="collapse mb-3" id="orderNoteCollapse">
                <div class="card card-body">
                    <label class="form-label small fw-semibold">Order Note</label>
                    <textarea class="form-control form-control-sm" 
                              id="cart-note" 
                              rows="3" 
                              placeholder="How can we help you?">{{ $note }}</textarea>
                    <button type="button" 
                            class="btn btn-dark btn-sm mt-2" 
                            onclick="saveNote()">
                        Save
                    </button>
                </div>
            </div>
            
            <!-- Shipping Info -->
            <p class="text-muted small text-center mb-3">
                Ongkir &amp; PPN dihitung saat checkout
            </p>
            
            <!-- Continue Shopping -->
            <a href="{{ route('collections', 'all') }}" 
               class="btn btn-outline-dark border-dark w-100 mb-2">
                Continue Shopping
            </a>
            
            <!-- Checkout Button -->
            <a href="{{ route('customer.cart') }}" 
               class="btn btn-dark w-100 d-flex justify-content-between align-items-center">
                <span>Checkout</span>
                <span class="fw-bold">{{ rupiah_format($total, true) }}</span>
            </a>
        </div>
    </div>
@else
    <!-- Empty Cart -->
    <div class="d-flex flex-column align-items-center justify-content-center h-100 p-5 text-center">
        <div class="mb-4">
            <span class="iconify" data-icon="mdi:cart-outline" style="font-size: 64px; color: #dee2e6;"></span>
        </div>
        <h5 class="mb-2">Cart is empty!</h5>
        <p class="text-muted mb-4">Add some products to your cart</p>
        <a href="{{ route('collections', 'all') }}" class="btn btn-dark">
            Continue Shopping
        </a>
    </div>
@endif
<script>
    function saveNote() {
        const noteValue = document.getElementById('cart-note')?.value.trim();
        if (noteValue !== '') {
            Livewire.emit('noteUpdated', noteValue);
            Livewire.emit('noteSaved', noteValue);
        }
    }

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

