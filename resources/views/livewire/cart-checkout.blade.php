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

                                            <input type="text" name="updates[]"class="QuantitySelector__CurrentQuantity" value="{{ $item->get('quantity') }}">

                                            @livewire('product-quantity-modal')
                                            @if(!$disabledPlus)
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
                                            @else
                                                <a href="javascript:void(0)"
                                                class="QuantitySelector__Button Link Link--primary"
                                                title="Set quantity to {{ $item->get('quantity') }} + 1"
                                                wire:disabled="true" style="cursor: not-allowed;">
                                                    <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                        <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                            <path d="M8,1 L8,15"></path>
                                                            <path d="M1,8 L15,8"></path>
                                                        </g>
                                                    </svg>
                                                </a>
                                            @endif
                                            {{-- <a href="javascript:void(0)"
                                            class="QuantitySelector__Button Link Link--primary"
                                            title="Set quantity to {{ $item->get('quantity') }} + 1"
                                            wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                            wire:disabled="{{ $disabledPlus }}">
                                                <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                    <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                    <path d="M8,1 L8,15"></path>
                                                    <path d="M1,8 L15,8"></path>
                                                    </g>
                                                </svg>
                                            </a> --}}
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
                                        <input type="text" name="updates[]"class="QuantitySelector__CurrentQuantity" value="{{ $item->get('quantity') }}">

                                        <a href="javascript:void(0)"
                                            class="QuantitySelector__Button Link Link--primary"
                                            title="Set quantity to {{ $item->get('quantity') }} + 1"
                                            wire:click="updateCartItem({{ $id }}, 'plus', {{ $item->get('quantity') }})"
                                            wire:disabled="{{ $disabledPlus }}">
                                            <svg class="Icon Icon--plus" role="presentation" viewBox="0 0 16 16">
                                                <g stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linecap="square">
                                                <path d="M8,1 L8,15"></path>
                                                <path d="M1,8 L15,8"></path>
                                                </g>
                                            </svg>
                                        </a>
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
                    </div>
                    <footer class="Cart__Footer">
                        <div class="Cart__NoteContainer">
                            <span class="Cart__NoteButton">Add Order Note</span>
                            <textarea class="Cart__Note Form__Textarea" name="note" id="cart-note" rows="4" placeholder="How can we help you?"></textarea>
                        </div>
                        <div class="Cart__Recap">
                            <p class="Cart__Total Heading u-h6">Total:
                                <span class="saso-cart-original-total">
                                    <span data-money-convertible="">
                                        <span class="money">Rp {{ rupiah_format($total) }}</span>
                                    </span>
                                </span>
                                <span class="saso-cart-total"></span>
                            </p>
                            <p class="Cart__Taxes Text--subdued">Ongkir &amp; PPN dihitung saat checkout</p>
                            <button type="submit" name="checkout" class="Cart__Checkout Button Button--primary Button--full">Checkout</button>
                        </div>
                    </footer>
                </form>
            </div>
        </div>
    @endif
</div>
