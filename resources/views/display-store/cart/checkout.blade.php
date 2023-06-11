@extends('display-store.store-theme._base')

@section('title', "Your Shopping Cart")

@push('styles')
<style>
    @media screen and (max-width: 640px) {
    #shopify-section-product-template+.shopify-section--bordered {
        border-top: 0;
    }

    #shopify-section-product-template+.shopify-section--bordered>.Section {
        padding-top: 0;
    }

    .Cart_Container {
        height: max(100% - var(--header-height), 100% - 60px);
            max-height: max(100% - var(--header-height), 100% - 90px);
    }

    .Cart_Clear {
        margin-left: 80px;
    }
}

.Drawer__Content_Livewire {
    height: calc(100% - var(--header-height));
        max-height: calc(100% - var(--header-height))
}
    </style>
@endpush

@section('body')
<div id="shopify-section-cart-template" class="shopify-section shopify-section--bordered">
    <section data-section-id="cart-template" data-section-type="cart" data-section-settings='{
    "type": "drawer",
    "itemCount": 1,
    "drawer": true,
    "hasShippingEstimator": false }'>
    </section>
    @livewire('cart-checkout')
</div>
@endsection

@push('scripts')

@endpush
