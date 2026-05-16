<x-customer-auth-layout>

    @push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/size-chart.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/transactions.css') }}" />
    @endpush

    <div style="margin-bottom: 2rem;">
        @auth
            <a href="{{ route('customer.dashboard') }}" class="back-button Button Button--primary ">BACK</a>
        @else
            <a href="{{ route('store') }}" class="back-button Button Button--primary ">BACK TO STORE</a>
        @endauth
    </div>
    <div class="header">
        <div>
            <span>Order <strong>#{{ strtoupper($transaction->token) }}</strong></span>
            <br>
            <span style="display: block; margin-top: 1rem; margin-bottom: 1rem">Payment Status:
                @if ($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
                <div class="chip pending">
                    <div class="chip-content">AWAITING PAYMENT</div>
                </div>
                @elseif($transaction->status == 'SETTLED' || $transaction->status == 'PAID' || $transaction->status == 'SUCCESS')
                <div class="chip paid">
                    <div class="chip-content">SUCCESS</div>
                </div>
                @elseif($transaction->status == 'EXPIRED' || $transaction->status == 'CANCELLED' || $transaction->status == 'REFUNDED' || $transaction->status == 'FAILED')
                <div class="chip expired">
                    <div class="chip-content">{{ $transaction->status }}</div>
                </div>
                @elseif($transaction->status == 'COMPLETED')
                <div class="chip completed">
                    <div class="chip-content">COMPLETED</div>
                </div>
                @endif
            </span>
            <span>
                Order placed on {{ date('d F Y h:iA', strtotime($transaction->created_at))}}
            </span>
        </div>
        <div>
            @if($transaction->status == 'PENDING' || $transaction->status == 'CREATED')
            <a href="{{ $transaction->snap_payment_url }}" id="btn-continue-payment" class="Form__Submit Button Button--primary" style="width: 250px; display: block;">Continue Payment</a>
            @endif

            @if(!$shipping_waybill && $transaction->status == 'SUCCESS')
            <div class="chip pending">
                <div class="chip-content">AWAITING SHIPMENT</div>
            </div>
            @endif

            @if($shipping_waybill && $transaction->status == 'SUCCESS')
            <a href="#" id="btn-check-shipping" class="Form__Submit Button Button--primary" style="width: 150px;">CEK RESI</a>
            @endif

            @if ($shipping_waybill && $transaction->status == 'COMPLETED')
            <div class="chip completed">
                <div class="chip-content">DELIVERED</div>
            </div>
            @endif
        </div>
    </div>
    <br>

    <div class="items">
        <div style="width: 80%;padding-right: 20px;">
            <div id="Order" class="tabcontent" style="display: block">
                <div class="table-header">
                    <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">PRODUCT</a></div>
                    <div class="header__item" style="max-width: 100px;"><a id="uk" class="filter__link filter__link--number" href="#">QUANTITY</a></div>
                    <div class="header__item" style="max-width: 150px;"><a id="cm" class="filter__link filter__link--number" href="#">TOTAL</a> </div>
                </div>
                <div class="table-content">
                    @foreach ($items as $item)
                    <div class="table-row">
                        <div class="table-data product">
                            <div class="image-with-text">
                                <div class="CartItem__ImageWrapper AspectRatio">
                                    <div class="AspectRatio" style="--aspect-ratio: 1.0">
                                        <img class="CartItem__Image" src="{{ getImage($item->detail->product->image, 'products/'.$item->detail->product->product_code) }}" alt="">
                                    </div>
                                </div>
                                <div class="text">
                                    <p>{{ $item->detail->product->product_name }}</p>
                                    <p>{{ $item->detail->size }}</p>
                                    <p>Rp {{ rupiah_format($item->price) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-data data" style="max-width: 100px;">{{ $item->quantity }}</div>
                        <div class="table-data data" style="max-width: 150px; text-align: end;">Rp {{ rupiah_format($item->quantity * $item->price) }}</div>
                    </div>
                    @endforeach
                    <div class="table-row">
                        <div class="table-data"></div>
                        <div class="table-data" style="max-width: 100px;text-align-last: end;">
                            Subtotal <br> 
                            @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                            <span style="color: #c83532;">Discount ({{ $transaction->voucher_code }})</span> <br>
                            @endif
                            Shipping <br> 
                            Total
                        </div>
                        <div class="table-data" style="max-width: 150px;text-align-last: end;">
                            Rp {{ rupiah_format($transaction->sub_total) }} <br> 
                            @if($transaction->voucher_discount && $transaction->voucher_discount > 0)
                            <span style="color: #c83532; font-weight: 600;">- Rp {{ rupiah_format($transaction->voucher_discount) }}</span> <br>
                            @endif
                            Rp {{ rupiah_format($shipping->shipping_cost) }} <br> 
                            Rp {{ rupiah_format($transaction->grand_total) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="max-width: 25%;">
            <h1>SHIPPING ADDRESS</h1>
            <p>
                <span>{{ $destination->first_name ?? '-' }} {{ $destination->last_name ?? '-' }}</span>
            </p>
            <p>
                <span>{{ $destination->address ?? '-' }}</span>
            </p>
            <p>
                <span>{{ $region->area ?? '-' }}</span> <br>
                <span>{{ $region->subdistrict ?? '-' }}</span> <br>
                <span>{{ $region->district ?? '-' }}</span> <br>
                <span>{{ $region->province ?? '-' }}</span> <br>
                <span>{{ $region->post_code ?? '-' }}</span> <br>
            </p>
            <p>
                <span>Phone Number: {{ $destination->phone_number ?? '-' }}</span>
            </p>
            <p>
                <span>Email: {{ $destination->email ?? '-' }}</span>
            </p>
        </div>
    </div>

    <div>
        <!-- The Modal -->
        <div id="modal-check-shipping" class="modal">
            <div class="modal-body">
                <span class="close closeShipping">&times;</span>
                <div style="text-align-last: center;">
                    <h1>Check shipping</h1>
                </div>
                @if (!$shipping_waybill)
                    <div class="chip pending">
                        <div class="chip-content">AWAITING SHIPMENT</div>
                    </div>
                @elseif ($shipping_waybill && $shipping_waybill['meta']['code'] == 200)
                    STATUS : {{ $shipping_waybill['data']['delivery_status']['status'] }} <br>
                    PENERIMA : {{ $shipping_waybill['data']['delivery_status']['pod_receiver'] }} <br>
                    WAKTU DITERIMA : {{ $shipping_waybill['data']['delivery_status']['pod_date'] }} {{ $shipping_waybill['data']['delivery_status']['pod_time'] }} <br>
                    <hr>
                    @foreach ($shipping_waybill['data']['manifest'] as $item)
                        {{ $item['manifest_description']}} : {{ $item['city_name'] }} <br>
                        TANGGAL : {{ $item['manifest_date']}} {{ $item['manifest_time']}} <br>
                        <hr>
                    @endforeach
                @else
                    {{ $shipping_waybill['meta']['message'] }}
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/pages/size-chart.js') }}" defer></script>
    <script>
        function closePayment() {
            var modalPayment = document.getElementById("modal-continue-payment");
            // When the user clicks on <span> (x), close the modal
            modalPayment.style.display = "none";
        }
        // Get the modal
        var modalPayment = document.getElementById("modal-continue-payment");
        var modalShipping = document.getElementById("modal-check-shipping");

        var btnShipping = document.getElementById("btn-check-shipping");

        // Get the <span> element that closes the modal
        var spanShipping = document.getElementsByClassName("closeShipping")[0];

        // When the user clicks on the button, open the modal
        btnShipping.onclick = function() {
            modalShipping.style.display = "block";
        }

        spanShipping.onclick = function() {
            modalShipping.style.display = "none";
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
