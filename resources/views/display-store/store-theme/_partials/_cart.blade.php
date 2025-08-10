<div id="sidebar-cart" class="Drawer Drawer--fromRight" aria-hidden="true" data-section-id="cart" data-section-type="cart" data-section-settings='{
    "type": "drawer",
    "itemCount": 1,
    "drawer": true,
    "hasShippingEstimator": false }' style="max-height: 929px;" tabindex="-1">
    <div class="Drawer__Header Drawer__Header--bordered Drawer__Container">
        <span class="Drawer__Title Heading u-h4">Cart</span>

        <button class="Drawer__Close Icon-Wrapper--clickable" data-action="close-drawer" data-drawer-id="sidebar-cart" aria-label="Close cart">
            <svg class="Icon Icon--close" role="presentation" viewBox="0 0 16 14">
            <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <form class="Cart Drawer__Content" action="{{ route('customer.cart') }}" method="POST" novalidate="">
        @csrf
        @livewire('cart-component')
    </form>
</div>
