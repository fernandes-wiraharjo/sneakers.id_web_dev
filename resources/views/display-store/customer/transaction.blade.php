<x-customer-auth-layout>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/size-chart.css') }}" />
        <style>
            .header {
                display: flex;
                flex-direction: row;
                align-content: center;
                align-items: center;
                justify-content: space-between;
            }

            .chip{
                display: inline-flex;
                flex-direction: row;
                background-color: #e5e5e5;
                border: none;
                cursor: default;
                height: 36px;
                outline: none;
                padding: 0;
                font-size: 14px;
                font-color: #333333;
                font-family:"Open Sans", sans-serif;
                white-space: nowrap;
                align-items: center;
                border-radius: 16px;
                vertical-align: middle;
                text-decoration: none;
                justify-content: center;
            }

            .chip-content{
                cursor: inherit;
                display: flex;
                align-items: center;
                user-select: none;
                white-space: nowrap;
                padding-left: 12px;
                padding-right: 12px;
            }

            .items {
                width: 100%;
                display: flex;
                align-content: center;
                flex-wrap: nowrap;
                align-items: stretch;
            }
            .tabcontent {
                border: 1px solid #ccc;
                margin-left: 0;
                margin-right: 0;
            }

            .table-row {
                border-bottom: 1px solid #ccc;
                align-items: center;
            }

            .product {
                text-align: left;
                align-items: center;
                display: inline-flex;
            }

            /* The Modal (background) */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 11;
                /* Sit on top */
                padding-top: 20px;
                /* Location of the box */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgb(0, 0, 0);
                /* Fallback color */
                background-color: rgba(0, 0, 0, 0.4);
                /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-body {
                position: relative;
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 30%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                -webkit-animation-name: animatetop;
                -webkit-animation-duration: 0.4s;
                animation-name: animatetop;
                animation-duration: 0.4s
            }

            /* Add Animation */
            @-webkit-keyframes animatetop {
                from {
                    top: -300px;
                    opacity: 0
                }

                to {
                    top: 0;
                    opacity: 1
                }
            }

            @keyframes animatetop {
                from {
                    top: -300px;
                    opacity: 0
                }

                to {
                    top: 0;
                    opacity: 1
                }
            }

            /* The Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .size-select,
            .size-select::before,
            .size-select::after {
                box-sizing: border-box;
            }

            .size-select {
                border: 1px solid #e7e7e7;
                padding: 12px 14px;
                font-size: 15px;
                font-weight: 400;
                font-style: normal;
                cursor: pointer;
                line-height: normal;
                transition: border-color .1s ease-in-out;
                background-color: transparent;
            }

            select:focus+.focus {
                position: absolute;
                top: -1px;
                left: -1px;
                right: -1px;
                bottom: -1px;
                border: 2px solid var(--select-focus);
                border-radius: 0;
            }

            .Form__Item {
                margin-bottom: 0;
            }
        </style>
    @endpush

    @if ($message = Session::get('success'))
        <div class="Form__Alert Alert Alert--success">
            <ul class="Alert__ErrorList">
                <li class="Alert__ErrorItem">{{ $message }}</li>
            </ul>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="Form__Alert Alert Alert--error">
            <ul class="Alert__ErrorList">
                <li class="Alert__ErrorItem">{{ $message }}</li>
            </ul>
        </div>
    @endif

    <div>
        <a href="{{ route('customer.dashboard') }}">BACK</a>
    </div>
    <div class="header">
        <div>
            <span>Order <strong>#{{ strtoupper($transaction->token) }}</strong></span>
            @if ($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                <div class="chip">
                    <div class="chip-content">Waiting for Payment</div>
                </div>
            @elseif($transaction->status == 'SETTLED' || $transaction->status == 'PAID')
                <div class="chip">
                    <div class="chip-content">PAID</div>
                </div>
            @elseif($transaction->status == 'EXPIRED')
                <div class="chip">
                    <div class="chip-content">EXPIRED / CANCELED</div>
                </div>
            @elseif($transaction->status == 'COMPLETED')
                <div class="chip">
                    <div class="chip-content">COMPLETED</div>
                </div>
            @endif
            <br>
            <span>
                Order placed on {{ date('d F Y h:iA', intval(explode('-', $transaction->token)[3]))}}
            </span>
        </div>
        <div>
            <a href="#" id="btn-continue-payment" class="Form__Submit Button Button--primary"
            style="width: 250px; {{ $transaction->status == 'PENDING' || $transaction->status == 'CREATED' ? 'display: block;' : 'display: none;'}}" {{ $transaction->status == 'PENDING' || $transaction->status == 'CREATED' ? '' : 'disabled'}}>Continue Payment</a>

            {{-- @if ($shipping_waybill) --}}
            <a href="#" id="{{ $shipping_waybill ? 'btn-check-shipping' : ''}}" class="Form__Submit Button {{ $shipping_waybill ? 'Button--primary' : 'Button--secondary'}} "
            style="width: 150px; {{ $transaction->status == 'SETTLED' || $transaction->status == 'PAID' ? 'display: block;' : 'display: none;' }}" {{ $transaction->status == 'SETTLED' || $transaction->status == 'PAID' ? ($shipping_waybill ? '' : 'disabled') : 'disabled'}}>CEK RESI</a>
            {{-- @else

            @endif --}}
        </div>
    </div>
    <br>

    <div class="items">
        <div style="padding-right: 20px;">
            <div id="Order" class="tabcontent" style="display: block">
                <div class="table-header">
                    <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">PRODUCT</a></div>
                    <div class="header__item" style="max-width: 100px;"><a id="uk" class="filter__link filter__link--number"href="#">QUANTITY</a></div>
                    <div class="header__item" style="max-width: 150px;"><a id="cm" class="filter__link filter__link--number" href="#">TOTAL</a> </div>
                </div>
                <div class="table-content">
                    @foreach ($items as $item)
                    <div class="table-row">
                        <div class="table-data product">
                            <div class="CartItem__ImageWrapper AspectRatio">
                                <div class="AspectRatio" style="--aspect-ratio: 1.0">
                                    <img class="CartItem__Image" src="{{getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code)}}" alt="">
                                </div>
                            </div>
                            {{ $item->detail->product->product_name }} <br>
                            {{ $item->detail->size }}<br>
                            Rp {{ rupiah_format($item->price / $item->quantity) }}
                        </div>
                        <div class="table-data data" style="max-width: 100px;">{{ $item->quantity }}</div>
                        <div class="table-data data" style="max-width: 150px;text-align-last: end;">Rp {{ rupiah_format($item->price) }}</div>
                    </div>
                    @endforeach
                    <div class="table-row">
                        <div class="table-data"></div>
                        <div class="table-data" style="max-width: 100px;text-align-last: end;">Subtotal <br> Shipping <br> Total</div>
                        <div class="table-data" style="max-width: 150px;text-align-last: end;">Rp {{ rupiah_format($transaction->sub_total) }} <br> Rp {{ rupiah_format($shipping->shipping_cost) }} <br> Rp {{ rupiah_format($transaction->grand_total) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="max-width: 25%;">
            <h1>USER ADDRESS</h1>
            <p>
                <span>{{ $user_info->name ?? '-' }}</span>
            </p>
            @if($user_address != null)
            <p>
                <span>{{ $user_address->address ?? '-' }}</span>
            </p>
            <p>
                <span>{{ $region->area ?? '-' }}</span> <br>
                <span>{{ $region->subdistrict ?? '-' }}</span> <br>
                <span>{{ $region->district ?? '-' }}</span> <br>
                <span>{{ $region->province ?? '-' }}</span> <br>
                <span>{{ $region->post_code ?? '-' }}</span> <br>
            </p>
            @else
            <p>
                Address not set.
            </p>
            @endif
            <div style="height: 50px;">

            </div>
            <h1>RECIPENT ADDRESS</h1>
            <p>
                <span>{{ $destination->first_name ?? '-' }} {{ $destination->last_name ?? '-' }}</span>
            </p>
            <p>
                <span>{{ $destination->address ?? '-' }}</span>
            </p>
            <p>
                <span>{{ $destination->region->area ?? '-' }}</span> <br>
                <span>{{ $destination->region->subdistrict ?? '-' }}</span> <br>
                <span>{{ $destination->region->district ?? '-' }}</span> <br>
                <span>{{ $destination->region->province ?? '-' }}</span> <br>
                <span>{{ $destination->region->post_code ?? '-' }}</span> <br>
            </p>
        </div>
    </div>
{{--
    @php

        dump($transaction);
        dump($shipping);
        dump($destination);
        dump($items);
    @endphp --}}

    <div>
        <!-- The Modal -->
        <div id="modal-continue-payment" class="modal">
            <div class="modal-body">
                <span class="closePayment">&times;</span>
                <div style="text-align-last: center;">
                    <h1>Continue Payment</h1>
                </div>
                @if ($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                <iframe id="iframe-invoice" class="iframe-invoice" title="Invoice" src="{{ $transaction->invoice_url }}">
                </iframe>
                @endif
            </div>
        </div>
    </div>

    <div>
        <!-- The Modal -->
        <div id="modal-check-shipping" class="modal">
            <div class="modal-body">
                <span class="closeShipping">&times;</span>
                <div style="text-align-last: center;">
                    <h1>Check shipping</h1>
                </div>
                @if ($shipping_waybill)
                @php
                    // dd($shipping_waybill['rajaongkir']['result']['delivery_status']);
                @endphp
                    @if($shipping_waybill['rajaongkir']['status']['code'] == 200)
                        STATUS : {{ $shipping_waybill['rajaongkir']['result']['delivery_status']['status'] }} <br>
                        PENERIMA : {{ $shipping_waybill['rajaongkir']['result']['delivery_status']['pod_receiver'] }} <br>
                        WAKTU DITERIMA : {{ $shipping_waybill['rajaongkir']['result']['delivery_status']['pod_date'] }} {{ $shipping_waybill['rajaongkir']['result']['delivery_status']['pod_time'] }} <br>
                        <hr>
                        @foreach ($shipping_waybill['rajaongkir']['result']['manifest'] as $item)
                            {{ $item['manifest_description']}} : {{  $item['city_name'] }} <br>
                            TANGGAL : {{ $item['manifest_date']}} {{ $item['manifest_time']}} <br>
                            <hr>
                        @endforeach
                    @else
                        {{ $shipping_waybill['rajaongkir']['status']['description'] }}
                    @endif
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/pages/size-chart.js') }}" defer></script>
        <script>
            // Get the modal
            var modalPayment = document.getElementById("modal-continue-payment");
            var modalShipping = document.getElementById("modal-check-shipping");

            // Get the button that opens the modal
            var btnPayment = document.getElementById("btn-continue-payment");

            var btnShipping = document.getElementById("btn-check-shipping");

            // Get the <span> element that closes the modal
            var spanPayment = document.getElementsByClassName("closePayment")[0];
            var spanShipping = document.getElementsByClassName("closeShipping")[0];

            // When the user clicks on the button, open the modal
            btnPayment.onclick = function() {
                modalPayment.style.display = "block";
            }
            btnShipping.onclick = function() {
                modalShipping.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            spanPayment.onclick = function() {
                modalPayment.style.display = "none";
            }

            spanShipping.onclick = function() {
                modalShipping.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modalPayment) {
                    modalPayment.style.display = "none";
                }
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modalShipping) {
                    modalShipping.style.display = "none";
                }
            }
        </script>
    @endpush
</x-customer-auth-layout>