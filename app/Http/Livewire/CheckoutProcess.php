<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use App\Facades\CekOngkir;
use App\Facades\CheckoutXendit;
use App\Models\Region as ModelRegion;

class CheckoutProcess extends Component
{
    public $currentStep = 1;
    public $successMessage = '';
    public $selectedCourier = []; //default jne
    public $selectedSubdistrict = 1;
    public $selectedProvince = '';
    public $selectedArea = '';

    public $shippingEmail = '';
    public $shippingFirstName = '';
    public $shippingLastName = '';
    public $shippingAddress = '';
    public $shippingPhoneNumber = '';
    public $shippingCity = '';
    public $shippingZipCode = '';
    public $shippingProvince = '';
    public $shippingDistrict = '';
    public $shippingSubDistrict = '';
    public $shippingCost = 0;
    public $shippingCourier;

    public $userRegion;
    public $district;
    public $subdistrict;
    public $area;
    public $postalCode;
    public $invoiceUrl;
    public $grandTotal = 0;
    public $currentUrl = '';
    protected $total;
    protected $content;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->userRegion = ModelRegion::where('region_id', auth()->user()->user_address->region_id ?? 18093)->first();

        $this->updateCart();
        $this->district = [];
        $this->subdistrict = [];
        $this->area = [];
        $this->postalCode = [];
        $this->currentUrl = url()->current();

        if(auth()->check()){
            $user = auth()->user();
            $this->shippingEmail = $user->email;
            $this->shippingFirstName = $user->first_name;
            $this->shippingLastName = $user->last_name;
            if($user->user_address) {
                $this->shippingAddress = $user->user_address->address;
                $this->shippingPhoneNumber = $user->user_address->phone_number;
                $this->updateDistrict($this->userRegion->province);
                $this->updateSubdistrict($this->userRegion->district);
                $this->updateArea($this->userRegion->subdistrict);
                $this->selectedArea = $this->userRegion->region_id;
                $this->shippingZipCode = $this->userRegion->post_code;
            }

        }

        $courier = CekOngkir::CostCourier($this->selectedSubdistrict, 'subdistrict',Cart::totalQuantity() * 1500, 'jne:jnt:pos:ninja:lion:anteraja:sicepat');
        $this->shippingCourier = CekOngkir::CostRangeCourier($courier);
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
        //submit shipping information into session TransactionSession
    }

    public function paymentStepSubmit()
    {
        $items = [];
        foreach(Cart::content() as $item) {
            $price = $item['retail_price'];
            if($item['discount_price'] != 0){
                $price = $item['discount_price'];
            }

            $items[] = [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $price,
                'category' => 'shoes',
                'url' => $item['url']
            ];
        }
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
        $this->invoiceUrl = CheckoutXendit::createInvoice([
            'currency' => 'IDR',
            'amount'    => intval($this->grandTotal),
            'success_redirect_url' => route('customer.payment.success'),
            'error_redirect_url' => route('customer.payment.error'),
            //make new pages for thankyou after success -> to recheck transaction id and update current status and give invoice response,
            'customer' => [
                'given_names' => $this->shippingFirstName,
                'surname' => $this->shippingLastName,
                'email' => $this->shippingEmail,
                'mobile_number' => $this->shippingPhoneNumber,
                'addresses' => [
                    [
                        'city' => $this->shippingDistrict,
                        'country' => 'indonesia',
                        'postal_code' => $this->shippingZipCode,
                        'state' => $this->shippingProvince,
                        'street_line1' => $this->shippingAddress,
                        'street_line2' => $this->shippingSubDistrict.', '.$this->selectedArea
                    ]
                ]
            ],
            'items' => $items,
            'fees' => [
                [
                    'type' => 'Shipping',
                    'value' => $this->shippingCost
                ]
            ]
        ], [
            'transactions' => [

            ],
            'transaction_destinations' => [

            ],
            'transaction_items' => [

            ],
            'transaction_shippings' => [

            ],
        ]);
        $this->currentStep = 4;
    }

    public function paymentSuccess(){
        $this->currentStep = 5;
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

    public function updateShippingCost($value, $courier, $service, $etd, $cartTotal)
    {
        $this->grandTotal = intval($cartTotal) + intval($value);
        $this->shippingCost = $value;
        $this->selectedCourier = [
            'courier'   => $courier,
            'service'   => $service,
            'cost'      => $value,
            'etd'       => $etd
        ];
    }

    public function updateDistrict($value) {
        $this->district = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $value)->get()->pluck('district');
        $this->shippingProvince = $value;
    }

    public function updateSubdistrict($value) {
        $getDistrict = ModelRegion::where('district', $value)->first();
        $this->shippingDistrict = $value;
        if($getDistrict->subdistrict_ro){
            $this->selectedSubdistrict = $getDistrict->subdistrict_ro;
            $destinationType = 'subdistrict';
        } else {
            $this->selectedSubdistrict = $getDistrict->city_ro;
            $destinationType = 'city';
        }
        $courier = CekOngkir::CostCourier($this->selectedSubdistrict, $destinationType, Cart::totalQuantity() * 1500, 'jne:jnt:pos:ninja:lion:anteraja:sicepat');
        $this->shippingCourier = CekOngkir::CostRangeCourier($courier);
        $this->subdistrict = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $value)->where('area', '<>','-')->get()->pluck('subdistrict');
    }

    public function updateArea($value) {
        $this->shippingSubDistrict = $value;
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
