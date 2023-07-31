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
    public $selectedSubdistrict = 0;
    public $selectedDistrict = '';
    public $selectedProvince = '';
    public $selectedArea = 0;

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
    public $shippingArea = '';
    public $shippingCost = 0;
    public $shippingCourier = [];
    public $shippingWeight;

    public $userRegion;
    public $districtList = [];
    public $subdistrictList = [];
    public $areaList = [];
    public $postalCode;
    public $invoiceUrl;
    public $grandTotal = 0;
    public $currentUrl = '';
    protected $note;
    protected $total;
    protected $content;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->total = Cart::total();
        $this->content = Cart::content();

        $this->userRegion = ModelRegion::where('region_id', auth()->user()->user_address->region_id ?? 18093)->where('subdistrict_ro', '<>', 'NULL')->first();

        $this->updateCart();
        $this->districtList = [];
        $this->subdistrictList = [];
        $this->areaList = [];
        $this->postalCode = [];
        $this->currentUrl = url()->current();
        $this->note = Cart::getNotes();

        if(auth()->check()){
            $user = auth()->user();
            $this->shippingEmail = $user->email;
            $this->shippingFirstName = $user->first_name;
            $this->shippingLastName = $user->last_name;
            if($user->user_address) {
                dd($this->userRegion);
                $this->selectedProvince = $this->userRegion->province;
                $this->selectedDistrict = $this->userRegion->district;
                $this->selectedSubdistrict = $this->userRegion->subdistrict_ro;
                $this->shippingAddress = $user->user_address->address;
                $this->shippingPhoneNumber = $user->user_address->phone_number;
                $this->updateDistrict($this->userRegion->province);
                $this->updateSubdistrict($this->userRegion->district);
                $this->updateArea($this->userRegion->subdistrict);
                $this->selectedArea = $this->userRegion->region_id;
                $this->shippingZipCode = $this->userRegion->post_code;
            }
            $this->shippingWeight = Cart::totalWeight();

        }
        //courier list 'jne:jnt:pos:ninja:lion:anteraja:sicepat'
        if($this->selectedSubdistrict) {
            $courier = CekOngkir::CostCourier($this->selectedSubdistrict, 'subdistrict',Cart::totalWeight(), 'jnt');
            $this->shippingCourier = CekOngkir::CostRangeCourier($courier);
        }
    }

    protected function rules()
    {
        return [
            'shippingEmail' => 'required|email',
            'shippingFirstName' => 'required|min:1',
            'shippingLastName' => 'required|min:1',
            'shippingAddress' => 'required',
            'selectedProvince' => 'required',
            'selectedDistrict' =>'required',
            'selectedSubdistrict' => 'required|gt:0',
            'selectedArea' => 'required|gt:0',
            'shippingZipCode' => 'required',
            'shippingPhoneNumber' => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'shippingEmail.required' => 'Email pengiriman harus diisi.',
            'shippingEmail.email' => 'Format email pengiriman tidak valid.',
            'shippingFirstName.required' => 'Nama depan pengiriman harus diisi.',
            'shippingFirstName.min' => 'Nama depan pengiriman minimal harus memiliki satu karakter.',
            'shippingLastName.required' => 'Nama belakang pengiriman harus diisi.',
            'shippingLastName.min' => 'Nama belakang pengiriman minimal harus memiliki satu karakter.',
            'shippingAddress.required' => 'Alamat pengiriman harus diisi.',
            'selectedProvince.required' => 'Provinsi untuk pengiriman harus dipilih.',
            'selectedDistrict.required' => 'Kabupaten/Kota untuk pengiriman harus dipilih.',
            'selectedSubdistrict.required' => 'Kecamatan untuk pengiriman harus dipilih.',
            'selectedSubdistrict.gt' => 'Kecamatan untuk pengiriman harus dipilih.',
            'selectedArea.required' => 'Area untuk pengiriman harus dipilih.',
            'selectedArea.gt' => 'Area untuk pengiriman harus dipilih.',
            'shippingZipCode.required' => 'Kode pos untuk pengiriman harus diisi.',
            'shippingPhoneNumber.required' => 'Nomor telepon untuk pengiriman harus diisi.',
        ];
    }

    public function informationStepSubmit()
    {
        $this->validate();
        $this->currentStep = 2;
        if($this->shippingCourier->count() == 0){
            $this->back(1);
            $this->emit('modalMessage', ['message' => 'Mohon coba lagi, Ongkir gagal dibaca dari pihak ke-3']);
        }
    }

    public function shippingStepSubmit()
    {
        $this->currentStep = 3;
        //submit shipping information into session TransactionSession
    }

    public function paymentStepSubmit()
    {
        $items = [];
        $totalQuantity = 0;
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

            $totalQuantity += $item['quantity'];
        }
        /**
         * if not logged in
         * user information email insert into user_guest
         * transaction_destination from if data information
         * if logged in
         *
         */
        $shipping_etd = $this->selectedCourier['etd'] ? '('.$this->selectedCourier['etd'].' Days)' : '(2-3 Days)';
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
                        'street_line2' => $this->shippingSubDistrict.', '.$this->shippingArea
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
                'date' => date('Y-m-d'),
                'gateway' => 'Xendit',
                'total_quantity' =>  $totalQuantity,
                'total_weight' =>  Cart::totalWeight(),
                'sub_total' => Cart::total(),
                'description' => Cart::getNotes(),
                'grand_total' => $this->grandTotal
            ],
            'transaction_destinations' => [
                'region_id' => $this->selectedArea,
                'email' => $this->shippingEmail,
                'first_name' => $this->shippingFirstName,
                'last_name' => $this->shippingLastName,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingPhoneNumber,
                'is_user' => auth()->check() ? 1 : 0,
                'user_id' => auth()->user()->id ?? 0,

            ],
            'transaction_items' => [
                'items' => Cart::content(),
            ],
            'transaction_shippings' => [
                 'shipping_method' => $this->selectedCourier['courier'].' '.$this->selectedCourier['service'].' '.$shipping_etd,
                 'shipping_cost' => $this->selectedCourier['cost'],
                 'shipping_weight' => $this->shippingWeight,
                 'origin_ro_id' => 2088,
                 'destination_ro_id' => $this->selectedSubdistrict,
            ],
        ]);

        //send mail confimarion payment here
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
        $this->selectedProvince = $value;
        $this->districtList = ModelRegion::selectRaw('DISTINCT(district)')->where('province', $value)->where('subdistrict_ro', '<>', 'NULL')->get()->pluck('district');
        // dd($this->district);
        $this->shippingProvince = $value;
        $this->selectedDistrict = '';
        $this->selectedSubdistrict = 0;
        $this->selectedArea = 0;
        $this->shippingZipCode = '';
    }

    public function updateSubdistrict($value) {
        $this->shippingDistrict = $value;
        $this->selectedDistrict = $value;

        $this->subdistrictList = ModelRegion::selectRaw('DISTINCT(subdistrict)')->where('district', $value)->where('area', '<>','-')->get()->pluck('subdistrict');
        $this->selectedSubdistrict = 0;
        $this->selectedArea = 0;
        $this->shippingZipCode = '';
    }

    public function updateZipCode($value) {
        $this->shippingZipCode = $value;
    }

    public function updateArea($value) {
        $this->shippingSubDistrict = $value;
        $getDistrict = ModelRegion::where('district', $this->selectedDistrict)->first();

        if($getDistrict) {
            if($getDistrict->subdistrict_ro){
                $this->selectedSubdistrict = $getDistrict->subdistrict_ro;
                $destinationType = 'subdistrict';
            } else {
                $this->selectedSubdistrict = $getDistrict->city_ro;
                $destinationType = 'city';
            }
            //courier list : 'jne:jnt:pos:ninja:lion:anteraja:sicepat'
            if($this->selectedSubdistrict) {
                $courier = CekOngkir::CostCourier($this->selectedSubdistrict, $destinationType, Cart::totalWeight(), 'jnt');
                $this->shippingCourier = CekOngkir::CostRangeCourier($courier);
            }
        } else {
            $this->selectedSubdistrict = 0;
        }
        $this->areaList = ModelRegion::where('subdistrict', $value)->get()->pluck('area','region_id');
        $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $value)->orderBy('post_code')->get()->pluck('post_code');
        $this->selectedArea = 0;
        $this->shippingZipCode = '';
    }

    public function areaUpdate($value) {
        $this->selectedArea = $value;
        $this->shippingArea = ModelRegion::where('region_id', $value)->first()->area;
    }

    public function render()
    {
        $province = ModelRegion::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');

        return view('livewire.checkout-process', [
            'session_id' => Cart::hashID(),
            'total' => intval(Cart::total()),
            'content' => Cart::content(),
            'province' => $province,
            'note' => Cart::getNotes()
        ]);
    }
}
