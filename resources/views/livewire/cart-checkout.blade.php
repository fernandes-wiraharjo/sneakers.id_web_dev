<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @if ($content->count() > 0)
        <div class="Container">
            <header class="PageHeader">
                <div class="SectionHeader SectionHeader--center">
                    <h1 class="SectionHeader__Heading Heading u-h1">Cart</h1>
                </div>
            </header>

            <div class="PageContent">
                <form action="{{route('customer.checkout.order', $session_id)}}" method="POST" class="Cart Cart--expanded" novalidate="">
                    @csrf
                    <input type="hidden" name="attributes[collection_mobile_items_per_row]" value="">
                    <input type="hidden" name="attributes[collection_desktop_items_per_row]" value="">
                    <input type="hidden" name="total" value="{{ $total }}">

                    <div class="Cart__ItemList">
                        <div class="Cart__Head hidden-phone">
                            <span class="Cart__HeadItem Heading Text--subdued u-h7">Product</span>
                            <span class="Cart__HeadItem"></span>
                            <span class="Cart__HeadItem Heading Text--subdued u-h7" style="text-align: center">Quantity</span>
                            <span class="Cart__HeadItem Heading Text--subdued u-h7" style="text-align: right">Total</span>
                        </div>
                        @foreach ($content as $id => $item)
                        {{ $disabledPlus[$id] ? 'true' : 'false'}}
                        <div class="CartItem">
                            <input type="hidden" name="cart_item[{{ $id }}][id]" value="{{ $id }}">
                            <input type="hidden" name="cart_item[{{ $id }}][product_code]" value="{{ $item->get('product_code') }}">
                            <input type="hidden" name="cart_item[{{ $id }}][quatity]" value="{{ $item->get('quantity') }}">
                            <div class="CartItem__ImageWrapper AspectRatio">
                                <div class="AspectRatio" style="--aspect-ratio: 1.0">
                                    <img class="CartItem__Image" src="{{ $item->get('image') }}" alt="">
                                </div>
                            </div>

                            <div class="CartItem__Info">
                                <h2 class="CartItem__Title Heading">
                                    <a href="{{ $item->get('url') }}">{{ $item->get('name') }}</a>
                                </h2>

                                <div class="CartItem__Meta Heading Text--subdued">
                                    <div class="CartItem__PriceList">
                                        <span class="CartItem__Price Price" data-money-convertible="">
                                            @if($item->get('discount_price') != 0)
                                            <span class="money">Rp
                                                <del id="retail">
                                                    {{ rupiah_format($item->get('retail_price')) }}
                                                </del>
                                                <span style="position:inherit; font-weight: 800;" id="discount">
                                                    {{ rupiah_format($item->get('discount_price')) }}
                                                </span></span>
                                            </span>
                                            @else
                                            <span class="money">Rp {{ rupiah_format($item->get('retail_price')) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="CartItem__Meta Heading Text--subdued">
                                    <span class="Cart__Taxes Text--subdued">Size : {{ $item->get('size') }} </span>
                                </div>
                                <div class="CartItem__Actions Heading Text--subdued" style="text-align: center">
                                    <div class="CartItem__QuantitySelector SOCKS">
                                        <div class="QuantitySelector">
                                            <a href="javascript:void(0)" class="QuantitySelector__Button Link Link--primary" title="Set quantity to {{ $item->get('quantity') - 1 }}" wire:click="updateCartItem({{ $id }}, 'minus', {{ $item->get('quantity') }})">
                                                <svg class="Icon Icon--minus" role="presentation" viewBox="0 0 16 2" >
                                                    <path d="M1,1 L15,1" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                                </svg>
                                            </a>

                                            <input type="text" 
                                                   name="updates[]"
                                                   class="QuantitySelector__CurrentQuantity" 
                                                   value="{{ $item->get('quantity') }}"
                                                   min="1"
                                                   readonly>

                                            @isset($disabledPlus)
                                                @isset($disabledPlus[$id])
                                                    <a href="javascript:void(0)"
                                                        class="QuantitySelector__Button Link Link--primary"
                                                        wire:disabled="{{ $disabledPlus[$id] ? 'true' : 'false'}}" style="{{ $disabledPlus[$id] ? 'cursor: not-allowed;' : ''}}"
                                                        title="Set quantity to {{ $item->get('quantity') }} + 1"
                                                        wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})">
                                                            <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                                <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                                    <path d="M8,1 L8,15"></path>
                                                                    <path d="M1,8 L15,8"></path>
                                                                </g>
                                                            </svg>
                                                    </a>
                                                @endisset
                                            @endisset
                                        </div>
                                    </div>

                                    <a class="CartItem__Remove Link Link--underline Link--underlineShort SOCKS" style="cursor: pointer;" wire:click="removeFromCart({{ $id }})">Remove</a>
                                </div>
                            </div>

                            <div class="CartItem__Actions Heading Text--subdued" style="text-align: center">
                                <div class="CartItem__QuantitySelector SOCKS">
                                    <div class="QuantitySelector">
                                        <a href="javascript:void(0)" class="QuantitySelector__Button Link Link--primary" title="Set quantity to {{ $item->get('quantity') - 1 }}" wire:click="updateCartItem({{ $id }}, 'minus', {{ $item->get('quantity') }})">
                                            <svg class="Icon Icon--minus" role="presentation" viewBox="0 0 16 2" >
                                                <path d="M1,1 L15,1" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                            </svg>
                                        </a>
                                        <input type="text" 
                                               name="updates[]"
                                               class="QuantitySelector__CurrentQuantity" 
                                               value="{{ $item->get('quantity') }}"
                                               min="1"
                                               readonly>

                                        @isset($disabledPlus)
                                            @isset($disabledPlus[$id])
                                                <a href="javascript:void(0)"
                                                class="QuantitySelector__Button Link Link--primary"
                                                wire:disabled="{{ $disabledPlus[$id] ? 'true' : 'false'}}" style="{{ $disabledPlus[$id] ? 'cursor: not-allowed;' : ''}}"
                                                title="Set quantity to {{ $item->get('quantity') }} + 1"
                                                wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})">
                                                    <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                        <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                            <path d="M8,1 L8,15"></path>
                                                            <path d="M1,8 L15,8"></path>
                                                        </g>
                                                    </svg>
                                                </a>
                                            @endisset
                                        @endisset
                                    </div>
                                </div>

                                <a class="CartItem__Remove Link Link--underline Link--underlineShort SOCKS" style="cursor: pointer;" wire:click="removeFromCart({{ $id }})">Remove</a>
                            </div>

                            <div class="CartItem__LinePriceList Heading Text--subdued" style="text-align: right">
                                <span class="CartItem__Price Price" data-money-convertible="">
                                    @if($item->get('discount_price') != 0)
                                    <span class="money">Rp {{ rupiah_format($item->get('quantity') * $item->get('discount_price')) }} </span>
                                    @else
                                    <span class="money">Rp {{ rupiah_format($item->get('quantity') * $item->get('retail_price')) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                        @livewire('product-quantity-modal', key('modal-checkout-1'))
                    </div>
                    <footer class="Cart__Footer">
                        <div>
                            {{-- Voucher Code Section --}}
                            <div class="Cart__VoucherContainer" style="margin-bottom: 20px;">
                                <label for="voucher_code" style="display: block; margin-bottom: 8px; font-weight: 600;">Have a voucher code?</label>
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" 
                                        wire:model.defer="voucherCode" 
                                        id="voucher_code" 
                                        class="Form__Input" 
                                        placeholder="Enter voucher code"
                                        style="flex: 1;"
                                        {{ $voucherApplied ? 'disabled' : '' }}>
                                    @if(!$voucherApplied)
                                        <button type="button" 
                                                wire:click="applyVoucher" 
                                                wire:loading.attr="disabled"
                                                class="Button Button--primary"
                                                style="white-space: nowrap;">
                                            <span wire:loading.remove wire:target="applyVoucher">Check Voucher</span>
                                            <span wire:loading wire:target="applyVoucher">Checking...</span>
                                        </button>
                                    @else
                                        <button type="button" 
                                                wire:click="removeVoucher" 
                                                class="Button Button--primary"
                                                style="white-space: nowrap;">
                                            Remove
                                        </button>
                                    @endif
                                </div>
                                @if($voucherMessage)
                                    <div style="margin-top: 8px; font-size: 14px; color: {{ $voucherApplied ? '#008060' : '#c83532' }};">
                                        {{ $voucherMessage }}
                                    </div>
                                @endif
                            </div>

                            <div class="Cart__NoteContainer">
                                <span class="Cart__NoteButton">{{ $note == '' ? 'Add Order Note' : 'Edit Order Note'}}</span>
                                <textarea class="Cart__Note Form__Textarea" wire:model.debounce.1000ms="note" id="cart-note" rows="4" placeholder="How can we help you?">{{ $note }}</textarea>
                            </div>
                        </div>
                        <div class="Cart__Recap">
                            <p class="Cart__Total Heading u-h6" style="margin-bottom: 10px;">Subtotal:
                                <span class="saso-cart-original-total">
                                    <span data-money-convertible="">
                                        <span class="money">Rp {{ rupiah_format($total) }}</span>
                                    </span>
                                </span>
                            </p>
                            @if($voucherApplied && $discountAmount > 0)
                                <p class="Cart__Discount" style="margin-bottom: 10px; color: #c83532;">Discount:
                                    <span style="color: #c83532; font-weight: 600;">- Rp {{ rupiah_format($discountAmount) }}</span>
                                </p>
                                <p class="Cart__Total Heading u-h6" style="margin-bottom: 10px; border-top: 1px solid #e5e5e5; padding-top: 10px;">Total:
                                    <span style="font-weight: 700;">Rp {{ rupiah_format($finalTotal) }}</span>
                                </p>
                            @endif
                            <p class="Cart__Taxes Text--subdued">Ongkir &amp; PPN dihitung saat checkout</p>
                            <button type="submit" name="checkout" class="Cart__Checkout Button Button--primary Button--full">Checkout</button>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    @else
    <div class="Container">
        <header class="PageHeader">
            <div class="SectionHeader SectionHeader--center">
                <h1 class="SectionHeader__Heading Heading u-h1">Cart</h1>
            </div>
        </header>

        <div class="PageContent">
            <a class="Cart__Checkout Button Button--primary Button--full" href="/collections/all">Continue Shopping</a>
        </div>
    </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('updateNote', () => {
                const textarea = document.getElementById('cart-note');
                Livewire.emit('updateNote', textarea.value); // Emit the updated note value to the Livewire component
            });
        });

        // Listen for quantity correction events
        window.addEventListener('quantity-corrected', event => {
            const sizeId = event.detail.size_id;
            const correctedQty = event.detail.quantity;
            
            // Find and update ALL input fields for this size_id (there are multiple for mobile/desktop views)
            const inputs = document.querySelectorAll(`input[data-size-id="${sizeId}"]`);
            inputs.forEach(input => {
                input.value = correctedQty;
            });
        });
    </script>
</div>
