<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SNEAKERS.ID - Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        p {
            margin: 0
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background-color: #e8eaf6;
            padding: 35px;
        }

        .box-right {
            padding: 30px 25px;
            background-color: white;
            border-radius: 15px
        }

        .box-left {
            padding: 20px 20px;
            background-color: white;
            border-radius: 15px
        }

        .textmuted {
            color: #7a7a7a
        }

        .bg-green {
            background-color: #d4f8f2;
            color: #06e67a;
            padding: 3px 0;
            display: inline;
            border-radius: 25px;
            font-size: 11px
        }

        .p-blue {
            font-size: 14px;
            color: #1976d2
        }

        .fas.fa-circle {
            font-size: 12px
        }

        .p-org {
            font-size: 14px;
            color: #fbc02d
        }

        .h7 {
            font-size: 15px
        }

        .h8 {
            font-size: 12px
        }

        .h9 {
            font-size: 10px
        }

        .bg-blue {
            background-color: #dfe9fc9c;
            border-radius: 5px
        }

        .form-control {
            box-shadow: none !important
        }

        .card input::placeholder {
            font-size: 14px
        }

        ::placeholder {
            font-size: 14px
        }

        input.card {
            position: relative
        }

        .far.fa-credit-card {
            position: absolute;
            top: 10px;
            padding: 0 15px
        }

        .fas,
        .far {
            cursor: pointer
        }

        .cursor {
            cursor: pointer
        }

        .btn.btn-primary {
            box-shadow: none;
            height: 40px;
            padding: 11px
        }

        .bg.btn.btn-primary {
            background-color: transparent;
            border: none;
            color: #1976d2
        }

        .bg.btn.btn-primary:hover {
            color: #539ee9
        }

        @media(max-width:320px) {
            .h8 {
                font-size: 11px
            }

            .h7 {
                font-size: 13px
            }

            ::placeholder {
                font-size: 10px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row m-0">
            <div class="col-12 py-2">
                <div class="box-right text-center" style="background-color: black; ">
                    <a href="/" class="">
                        @if (config('ladmin.logo'))
                            <img class="" src="{{ config('ladmin.logo') }}"
                                srcset="{{ config('ladmin.logo') }} 1x, {{ config('ladmin.logo') }} 2x" height="100px"
                                width="auto" style="max-height: 90px !important; " alt="{{ config('app.name') }}" />
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-12 px-0">
                        <div class="box-right">
                            <div class="d-flex mb-2">
                                <p class="fw-bold">Payment</p>
                                <p class="ms-auto textmuted"><span class="fas fa-times"></span></p>
                            </div>
                            <div class="d-flex mb-2">
                                <p class="h7">Already have an account? <a href="#">Log in</a></p>
                            </div>
                            <div class="row">
                                <div class="col-12 px-0">
                                    <p class="fw-bold">Contact</p>

                                    <p class="textmuted h8">Email or Phonenumber</p>
                                    <input class="form-control" type="text" placeholder="Email or Phonenumber">

                                    <br>
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Sign up to get order updates on WhatsApp
                                        </label>
                                    </div> --}}
                                </div>

                                <hr>

                                <div class="col-12 px-0">
                                    <p class="fw-bold">Shipping address</p>

                                    <p class="textmuted h8">Country / Region</p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>

                                    <p class="textmuted h8">Nama depan</p>
                                    <input class="form-control" type="text" placeholder="Nama Depan">

                                    <p class="textmuted h8">Nama belakang</p>
                                    <input class="form-control" type="text" placeholder="Nama Belakang">

                                    <p class="textmuted h8">Alamat</p>
                                    <input class="form-control" type="text" placeholder="Alamat">

                                    <p class="textmuted h8">Kota</p>
                                    <input class="form-control" type="text" placeholder="Kota">

                                    <p class="textmuted h8">Kecamatan</p>
                                    <input class="form-control" type="text" placeholder="Kecamatan">

                                    <p class="textmuted h8">Provinsi</p>
                                    <input class="form-control" type="text" placeholder="Provinsi">

                                    <p class="textmuted h8">Kode Pos</p>
                                    <input class="form-control" type="text" placeholder="Kode Pos">
                                </div>
                                <br>
                                <hr>
                                <a href="#">< return to cart</a>

                                <div class="row">
                                    <div class="col-4">
                                        <a href="#">Refund policy</a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">Privacy policy</a>
                                    </div>
                                    <div class="col-4">
                                        <a href="#">Terms of service</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4 mt-4">
                        <div class="row box-right">
                            <div class="_1fragem15 _1fragemah _1fragemaf">
                                <legend>Choose a payment method</legend>
                            </div>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/bca.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - BCA</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/bsi.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - BSI</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/bri.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - BRI</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/bni.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - BNI</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/mandiri.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - Mandiri</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/permata.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Bank Transfer - Permata</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/alfamart.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Pay at Alfamart Group</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/ovo.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">OVO</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/dana.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Dana</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/linkaja.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">LinkAja</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/qris.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">QRIS</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <img src="https://habiskerja.com/wp-content/plugins/midtrans-woocommerce/public/images/payment-methods/qris.png"
                                                        alt="Midtrans"
                                                        style="max-height: 2em; max-width: 4em; background-color: #ffffffdd; padding: 0.2em 0.3em; border-radius: 0.3em; border: 0.5px solid #ccccccdd;">
                                                    <img src="https://habiskerja.com/wp-content/plugins/midtrans-woocommerce/public/images/payment-methods/gopay.png"
                                                        alt="Xendit"
                                                        style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">GoPay</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/shopeepay.svg"
                                                    alt="Xendit"
                                                    style="margin-left: 0.3em; max-height: 28px; max-width: 65px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">ShopeePay</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="size d-flex ps-4">
                                        <label class="option d-flex align-items-center">
                                            <input type="radio" name="radio">
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center justify-content-center"> <img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/jcb.svg"
                                                    alt="Xendit"
                                                    style="float:right; max-height:28px; max-width:35px; margin-top:3px;"><img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/mastercard.svg"
                                                    alt="Xendit"
                                                    style="float:right; max-height:28px; max-width:35px; margin-top:3px;"><img
                                                    src="https://habiskerja.com/wp-content/plugins/woo-xendit-virtual-accounts/assets/images/visa.svg"
                                                    alt="Xendit"
                                                    style="float:right; max-height:28px; max-width:35px; margin-top:3px;">
                                                </div>
                                                <div class=" d-flex flex-column px-3">
                                                    <p class="fw-bold pb-1">Kartu Kredit</p>
                                                </div>
                                            </div>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                              </ul>


                        {{-- <div class="col-md-8 ps-0 ">
                                <p class="ps-3 textmuted fw-bold h6 mb-0">TOTAL RECIEVED</p>
                                <p class="h1 fw-bold d-flex"> <span
                                        class=" fas fa-dollar-sign textmuted pe-1 h6 align-text-top mt-1"></span>84,254
                                    <span class="textmuted">.58</span>
                                </p>
                                <p class="ms-3 px-2 bg-green">+10% since last month</p>
                            </div>
                            <div class="col-md-4">
                                <p class="p-blue"> <span class="fas fa-circle pe-2"></span>Pending </p>
                                <p class="fw-bold mb-3"><span class="fas fa-dollar-sign pe-1"></span>1254 <span
                                        class="textmuted">.50</span> </p>
                                <p class="p-org"><span class="fas fa-circle pe-2"></span>On drafts</p>
                                <p class="fw-bold"><span class="fas fa-dollar-sign pe-1"></span>00<span
                                        class="textmuted">.00</span></p>
                            </div> --}}
                    </div>
                </div>
                {{-- <div class="col-12 px-0 mb-4">
                        <div class="box-right">
                            <div class="d-flex pb-2">
                                <p class="fw-bold h7"><span class="textmuted">quickpay.to/</span>Publicnote</p>
                                <p class="ms-auto p-blue"><span
                                        class=" bg btn btn-primary fas fa-pencil-alt me-3"></span> <span
                                        class=" bg btn btn-primary far fa-clone"></span> </p>
                            </div>
                            <div class="bg-blue p-2">
                                <P class="h8 textmuted">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Laborum recusandae dolorem voluptas nemo, modi eos minus nesciunt.
                                <p class="p-blue bg btn btn-primary h8">LEARN MORE</p>
                                </P>
                            </div>
                        </div>
                    </div> --}}

            </div>
        </div>
        <div class="col-md-5 col-12 ps-md-5 p-0 ">
            <div class="box-left">
                {{-- mobile --}}
                <div>
                    <div>
                        Klik disini untuk menerapkan kode voucher v
                    </div>
                    <div>
                        Rp 102.000,00
                    </div>
                    {{-- dropdown --}}
                </div>

                {{-- web --}}
                <div>
                    <div>
                        Image
                        <div>
                            <span>
                                Product Name
                            </span>
                            <span>
                                Rp 99.000,00
                            </span>
                        </div>
                    </div>
                    <div>
                        subtotal Rp 99.000,00
                        shipping Rp 3.000,00
                        Total IDR Rp 102.000,-
                    </div>
                </div>
                {{-- <p class="textmuted h8">Invoice</p>
                    <p class="fw-bold h7">Alex Parkinson</p>
                    <p class="textmuted h8">3897 Hickroy St, salt Lake city</p>
                    <p class="textmuted h8 mb-2">Utah, United States 84104</p>
                    <div class="h8">
                        <div class="row m-0 border mb-3">
                            <div class="col-6 h8 pe-0 ps-2">
                                <p class="textmuted py-2">Items</p> <span class="d-block py-2 border-bottom">Legal
                                    Advising</span> <span class="d-block py-2">Expert Consulting</span>
                            </div>
                            <div class="col-2 text-center p-0">
                                <p class="textmuted p-2">Qty</p> <span class="d-block p-2 border-bottom">2</span>
                                <span class="d-block p-2">1</span>
                            </div>
                            <div class="col-2 p-0 text-center h8 border-end">
                                <p class="textmuted p-2">Price</p> <span class="d-block border-bottom py-2"><span
                                        class="fas fa-dollar-sign"></span>500</span> <span class="d-block py-2 "><span
                                        class="fas fa-dollar-sign"></span>400</span>
                            </div>
                            <div class="col-2 p-0 text-center">
                                <p class="textmuted p-2">Total</p> <span class="d-block py-2 border-bottom"><span
                                        class="fas fa-dollar-sign"></span>1000</span> <span class="d-block py-2"><span
                                        class="fas fa-dollar-sign"></span>400</span>
                            </div>
                        </div> --}}

                <div class="_1ip0g651 _1fragem1b _1fragemaf _1fragem1t _1fragem2a">
                    <fieldset id="shipping_methods">
                        <div class="_1fragem15 _1fragemah _1fragemaf">
                            <legend>Choose a shipping method</legend>
                        </div>
                        <div class="Wo4qW m5ItP NDMe9 NdTJE PuVf0">
                            <div class="B4zH6 Zb82w HKtYc OpmPd"><label
                                    for="shipping_methods-b9c217e514b07424b6b7a84c20168549-bf70360ee54f1d127f508b53f7c21351"
                                    class="yL8c2 D1RJr">
                                    <div class="hEGyz">
                                        <div class="_1fragemaf"><input type="radio"
                                                id="shipping_methods-b9c217e514b07424b6b7a84c20168549-bf70360ee54f1d127f508b53f7c21351"
                                                name="shipping_methods"
                                                class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe">
                                        </div>
                                        <div class="f5aCe">
                                            <div>
                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j">FREE SHIPPING
                                                    (Max Rp.12.000,-)</p>
                                            </div>
                                            <div><span translate="yes"
                                                    class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp3,000.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </label></div>
                            <div class="B4zH6"><label
                                    for="shipping_methods-b9c217e514b07424b6b7a84c20168549-848ab1619f64c8e414ee5cc0204ec3be"
                                    class="yL8c2 D1RJr">
                                    <div class="hEGyz">
                                        <div class="_1fragemaf"><input type="radio"
                                                id="shipping_methods-b9c217e514b07424b6b7a84c20168549-848ab1619f64c8e414ee5cc0204ec3be"
                                                name="shipping_methods"
                                                class="_6hzjvo5 _1fragem13 _1fragem15 _1fragemat _1fragemao _1fragemaz _6hzjvoi _6hzjvo8 _6hzjvoc _6hzjvoh _6hzjvoe">
                                        </div>
                                        <div class="f5aCe">
                                            <div>
                                                <p class="_1x52f9s1 _1fragemaf _1x52f9sl _1fragem1j">JNE REG (3-4
                                                    Days)</p>
                                            </div>
                                            <div><span translate="yes"
                                                    class="_19gi7yt0 _19gi7yte _1fragem1j _19gi7yt1 notranslate">Rp15,000.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </label></div>
                        </div>
                    </fieldset>
                </div>

                <div class="d-flex h7 mb-2">
                    <p class="">Total Amount</p>
                    <p class="ms-auto"><span class="fas fa-dollar-sign"></span>1400</p>
                </div>
                <div class="h8 mb-5">
                    <p class="textmuted">All transactions are
                        secure and encrypted.
                    </p>
                </div>
            </div>
            <div class="py-2">
                <div class="btn btn-primary d-block h8">PAY <span class="fas fa-dollar-sign ms-2"></span>1400<span
                        class="ms-3 fas fa-arrow-right"></span></div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
