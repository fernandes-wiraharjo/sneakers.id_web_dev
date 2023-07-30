<div class="Drawer__Content_Livewire">
        {{-- In work, do what you enjoy. --}}
        @if ($content->count() > 0)
        <div class="Drawer__Main Cart_Container" data-scrollable="">
            <div class="Drawer__Container">
                <input type="hidden" name="attributes[collection_mobile_items_per_row]" value="">
                <input type="hidden" name="attributes[collection_desktop_items_per_row]" value="">
                <input type="hidden" name="total" value="{{ $total }}">

                <div class="Cart__ItemList">
                    <div class="CartItemWrapper">
                        @foreach ($content as $id => $item)
                        <input type="hidden" name="cart_item[{{ $id }}][id]" value="{{ $id }}">
                        <input type="hidden" name="cart_item[{{ $id }}][product_code]" value="{{ $item->get('product_code') }}">
                        <input type="hidden" name="cart_item[{{ $id }}][quatity]" value="{{ $item->get('quantity') }}">
                        <div class="CartItem">
                            <div class="CartItem__ImageWrapper AspectRatio">
                                <div class="AspectRatio" style="--aspect-ratio: 1.0">
                                    <img class="CartItem__Image" src="{{ $item->get('image') }}" alt="">
                                </div>
                            </div>

                            <div class="CartItem__Info" style="text-align-last: center;">
                                <h2 class="CartItem__Title Heading" style="white-space: unset;overflow-wrap: break-word;text-align: -webkit-center;">
                                    <a href="{{ $item->get('url') }}">{{ $item->get('name') }}</a>
                                </h2>
                                <div class="CartItem__Meta Heading Text--subdued">
                                    <ul class="CartItem__PropertyList"></ul>
                                    <div class="CartItem__PriceList" style="margin-bottom: 0px;">
                                        <span class="CartItem__Price Price" data-money-convertible="">
                                            @if($item->get('discount_price') != 0)

                                            <span class="money">Rp
                                                <del>
                                                    {{ rupiah_format($item->get('retail_price')) }}
                                                </del>
                                                <span style="position:inherit; font-weight: 800;">
                                                    {{ rupiah_format($item->get('discount_price')) }}
                                                </span></span>
                                            </span>
                                            @else
                                            <span class="money">Rp {{ rupiah_format($item->get('retail_price')) }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <h2 class="CartItem__Title Heading">
                                    <span class="Cart__Taxes">Size : {{ $item->get('size') }} </span>
                                </h2>
                                <div class="CartItem__Actions Heading Text--subdued" style="text-align: center">
                                    <div class="CartItem__QuantitySelector SOCKS">
                                        <div class="QuantitySelector">
                                            <a href="javascript:void(0)" class="QuantitySelector__Button Link Link--primary" title="Set quantity to {{ $item->get('quantity') - 1 }}" wire:click="updateCartItem({{ $id }}, 'minus', {{ $item->get('quantity') }})">
                                                <svg class="Icon Icon--minus" role="presentation" viewBox="0 0 16 2" >
                                                    <path d="M1,1 L15,1" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square"></path>
                                                </svg>
                                            </a>

                                            <input type="text" name="updates[]"class="QuantitySelector__CurrentQuantity" value="{{ $item->get('quantity') }}">
                                            @if($disabledPlus != [])
                                                @if($disabledPlus[$id])
                                                <a href="javascript:void(0)"
                                                    class="QuantitySelector__Button Link Link--primary"
                                                    title="product stock has reach the limit"
                                                    wire:disabled="true" style="cursor: not-allowed;">
                                                        <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                            <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                                <path d="M8,1 L8,15"></path>
                                                                <path d="M1,8 L15,8"></path>
                                                            </g>
                                                        </svg>
                                                </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="QuantitySelector__Button Link Link--primary"
                                                        title="Set quantity to {{ $item->get('quantity') }} + 1"
                                                        wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})">
                                                            <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                                <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                                    <path d="M8,1 L8,15"></path>
                                                                    <path d="M1,8 L15,8"></path>
                                                                </g>
                                                            </svg>
                                                    </a>
                                                @endif
                                            @else
                                               <a href="javascript:void(0)"
                                                    class="QuantitySelector__Button Link Link--primary"
                                                    title="Set quantity to {{ $item->get('quantity') }} + 1"
                                                    wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})">
                                                        <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                            <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                                <path d="M8,1 L8,15"></path>
                                                                <path d="M1,8 L15,8"></path>
                                                            </g>
                                                        </svg>
                                                </a>
                                            @endif
                                            {{-- <a href="javascript:void(0)" class="QuantitySelector__Button Link Link--primary" title="Set quantity to {{ $item->get('quantity') }} + 1" wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})" wire:disabled="{{ $disabledPlus }}">
                                                <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                    <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                    <path d="M8,1 L8,15"></path>
                                                    <path d="M1,8 L15,8"></path>
                                                    </g>
                                                </svg>
                                            </a> --}}
                                        </div>
                                    </div>

                                    <a class="CartItem__Remove Link Link--underline Link--underlineShort SOCKS" style="cursor: pointer;" wire:click="removeFromCart({{ $id }})"> Remove</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @livewire('product-quantity-modal', key('modal-component-1'))
                    </div>
                </div>
            </div>
        </div>
        <div class="Drawer__Footer" data-drawer-animated-bottom="">
                <div class="text-center">
                    <button type="button" class="Cart__NoteButton" data-action="toggle-cart-note">{{ $note == '' ? 'Add Order Note' :' Edit Order Note'}}</button>
                    <a href="javascript:void(0);" class="Cart__Taxes Text--subdued Cart_Clear" wire:click="clearCart">Clear Cart</a>
                </div>

                <p class="Cart__Taxes Text--subdued">Ongkir &amp; PPN dihitung saat checkout</p>
                <a class="Cart__Checkout Button Button--primary Button--full" href="/collections/all-products/">Continue Shopping</a>
            <a href="{{ route('customer.cart') }}" name="cart" class="Cart__Checkout Button Button--primary Button--full">
                <span>Checkout</span>
                <span class="Button__SeparatorDot"></span>
                <span data-money-convertible="">
                    <span class="money">Rp {{ rupiah_format($total) }}</span>
                </span>
            </a>
            <div class="Cart__OffscreenNoteContainer" aria-hidden="true"><span class="Cart__NoteButton">{{ $note == '' ? 'Add Order Note' :' Edit Order Note'}}</span>
                <div class="Form__Item">
                    <textarea class="Cart__Note Form__Textarea" id="cart-note" rows="3" placeholder="How can we help you?" data-scrollable="">{{$note}}</textarea>
                </div>

                <a href="javascript:void(0);" class="Button Button--primary Button--full" onclick="saveNote()" id="cart-note" data-action="toggle-cart-note">Save</a>
            </div>
        </div>
        @else
        <div class="Drawer__Main" data-scrollable="">
            <div class="Drawer__Container">
                <input type="hidden" name="attributes[collection_mobile_items_per_row]" value="">
                <input type="hidden" name="attributes[collection_desktop_items_per_row]" value="">
                <div class="Cart__ItemList">
                    <div class="CartItemWrapper">
                        <div class="CartItem">
                        <p class="">cart is empty!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Drawer__Footer" data-drawer-animated-bottom="">
            <a class="Cart__Checkout Button Button--primary Button--full" href="/collections/all">Continue Shopping</a>
        </div>
        @endif
        <script>
            function saveNote() {
                const noteValue = document.getElementById('cart-note').value.trim();
                // Call the Livewire method to update the note property only when the textarea is not empty
                if (noteValue !== '') {
                    console.log(noteValue);
                    Livewire.emit('noteUpdated', noteValue);
                    Livewire.emit('noteSaved', noteValue);
                }
                // Optionally, you can add further logic or validation here.
            };

            document.addEventListener('livewire:click', function (event) {
                // event.target contains the element that triggered the Livewire click event
                // You can perform actions based on the event.target if needed
                console.log('Livewire click event was triggered on:', event.target);
            });
        </script>
</div>

