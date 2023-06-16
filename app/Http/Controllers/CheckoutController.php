<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Xendit\Xendit;
use App\Http\Facade\CheckoutXendit as Service;
use App\Http\Facade\Cart as CartService;

class CheckoutController extends BaseController {

    public function successPayments($id)
    {
        //clear cart
        //after few second redirect to dashboard
        Cart::clear();
        return view('display-store.customer.payment.success');
    }

    public function errorPayments()
    {
        //after few second redirect to cart
        return view('display-store.customer.payment.error');
    }
}
