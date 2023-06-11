<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use App\Models\Region as ModelRegion;

class CheckoutProcess extends Component
{
    public $currentStep = 1;
    public $successMessage = '';
    public $selectedCourier = 'jne'; //default jne
    public $selectedProvince;
    public $selectedArea;
    public $shippingEmail = '';
    public $shippingFirstName = '';
    public $shippingLastName = '';
    public $shippingAddress = '';
    public $shippingPhoneNumber = '';
    public $shippingCost = 0;
    public $userRegion;
    public $district;
    public $subdistrict;
    public $area;
    public $postalCode;
    protected $total;
    protected $content;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->updateCart();
        $this->district = [];
        $this->subdistrict = [];
        $this->area = [];
        $this->postalCode = [];
        $this->userRegion = ModelRegion::where('region_id', auth()->user()->user_address->region_id ?? 18093)->first();
    }

    public function informationStepSubmit()
    {
        $this->currentStep = 2;
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    public function shippingStepSubmit()
    {
        $this->currentStep = 3;
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    public function paymentStepSubmit()
    {
        /**
         * if not logged in
         * user information email insert into user_guest
         * transaction_destination from if data information
         * if logged in
         *
         */

        //useremail (transaction -> email (as user id) )
        //
        //submit paymet data
        //payment method
        //destination ro_city
        //shippingcost
        //subtotal
        //grandtotal
        $this->currentStep = 4;
    }

    public function checkOngkir()
    {

    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = Cart::total();
        $this->content = Cart::content();
    }

    public function updateShippingCost($value)
    {
        $this->shippingCost = $value;
    }

    public function updateDistrict($value) {
        $this->district = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $value)->get()->pluck('district');
    }

    public function updateSubdistrict($value) {
        $this->subdistrict = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $value)->where('area', '<>','-')->get()->pluck('subdistrict');
    }

    public function updateArea($value) {
        $this->area = ModelRegion::where('subdistrict', $value)->get()->pluck('area','region_id');
        $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $value)->orderBy('post_code')->get()->pluck('post_code');
    }

    public function render()
    {
        $province = ModelRegion::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');

        return view('livewire.checkout-process', [
            'session_id' => Cart::hashID(),
            'total' => intval(Cart::total()),
            'content' => Cart::content(),
            'province' => $province,
        ]);
    }
}
