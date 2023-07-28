<x-customer-auth-layout>

    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/size-chart.css') }}" />
        <style>
            .tabcontent {
                border: 1px solid #ccc;
                margin-left: 0;
                margin-right: 0;
            }

            .table-row {
                border-bottom: 1px solid #ccc;
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
                transform: unset;
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
                margin: unset;
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

    @if (!auth()->user()->is_email_verified)
        <h4>Verification your email!</h4>

        <span>Thank you for signing up for our service! To ensure the security and validity of your account, we kindly
            request you to verify your email address.
            <span><a href="{{ route('customer.verify-email', $token) }}" class="Form__Submit Button Button--primary"
                style="width: 150px;">VERIFY HERE</a></span>
        </span>
        <br>
    @endif

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


    MY ACCOUNT
    <br>
    Welcome back, {{ auth()->user()->name ?? '-' }}
    @php
        // dd($transaction);
    @endphp
    <br>
    <br>
    <div id="Order" class="tabcontent" style="display: block">
        <div class="table-header">
            <div class="header__item"><a id="us" class="filter__link filter__link--number" href="#">ORDER</a>
            </div>
            <div class="header__item"><a id="uk" class="filter__link filter__link--number"
                    href="#">DATE</a>
            </div>
            <div class="header__item"><a id="cm" class="filter__link filter__link--number" href="#">ORDER
                    STATUS</a>
            </div>
            <div class="header__item"><a id="eu" class="filter__link filter__link--number"
                    href="#">TOTAL</a>
            </div>
        </div>
        <div class="table-content"  style="height: 300px; overflow: auto;">
        @if ($transaction)
            @foreach ($transaction as $item)
            <div class="table-row">
                <div class="table-data"><a href="{{ route('customer.transaction.detail', $item->transaction->token) }}"><strong>#{{strtoupper($item->transaction->token)}}</strong></a></div>
                <div class="table-data">{{ date('d F Y', strtotime($item->transaction->date)) }}</div>
                <div class="table-data">{{ $item->transaction->status }}</div>
                <div class="table-data">RP {{ rupiah_format(intval($item->transaction->grand_total)) }}</div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
    <div>
        <h1>ADDRESS</h1>
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
        <a href="#" id="edit-my-account" class="Form__Submit Button Button--primary"
            style="width: 150px;">EDIT</a>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-body">
                <span class="close">&times;</span>
                <div style="text-align-last: center;">
                    <h1>EDIT ACCOUNT</h1>
                    <p>Please fill information below :</p>
                </div>
                <form action="{{ route('customer.address.save' )}}" method="POST">
                    @csrf
                    <!--begin::Input group-->
                    <div style="padding: 10px 0px;">
                        <!--begin::Label-->
                        <label class="Heading u-h6">{{ __('FIRST NAME') }}</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="Form__Input" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', split_name($user_info->name)[0])}}"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div style="padding: 10px 0px;">
                        <!--begin::Label-->
                        <label class="Heading u-h6">{{ __('LAST NAME') }}</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="Form__Input" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name', split_name($user_info->name)[1])}}"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div style="padding: 10px 0px;">
                        <!--begin::Label-->
                        <label class="Heading u-h6">{{ __('PHONE NUMBER') }}</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="Form__Input" type="text" name="phone_number" placeholder="Phone Number" value="{{ old('phone_numbe', $user_address->phone_number ?? '')}}"/>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div style="padding: 10px 0px;">
                        <!--begin::Label-->
                        <label class="Heading u-h6">{{ __('ADDRESS') }}</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <textarea class="Form__Input" name="address" />{{ old('address', $user_address->address ?? '') }}</textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                @livewire('region', ['user_region' => $region, 'province' => $province])

                    <div style="padding: 10px 0px;">
                        <button class="Form__Submit Button Button--primary">SAVE</button>
                    </div>
                    <!--end::Input group-->
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/pages/size-chart.js') }}" defer></script>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("edit-my-account");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    @endpush
</x-customer-auth-layout>
