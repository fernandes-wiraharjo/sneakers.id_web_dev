<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use App\Facades\CekOngkir;
use App\Facades\CheckoutMidtrans;
use App\Facades\CheckoutXendit;
use App\Models\Region as ModelRegion;
use App\Services\MidtransService;
use App\Models\ShippingCourier;
use App\Models\UserAddress;
use Ramsey\Uuid\Uuid;
use Xendit\Transaction;
use Illuminate\Support\Str;

class CheckoutProcess extends Component
{
    public $currentStep = 1;
    public $successMessage = '';
    public $selectedCourier = []; //default jne
    public $selectedSubdistrict = 0;
    public $selectedDistrict = '';
    public $selectedProvince = '';
    public $selectedArea = 0;
    public $selectedPaymentGateway = null;

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
    public $originSubdistrict;

    public $userRegion;
    public $districtList = [];
    public $subdistrictList = [];
    public $areaList = [];
    public $postalCode;
    public $invoiceUrl;
    public $grandTotal = 0;
    public $currentUrl = '';
    public $saveAddress = false;
    protected $note;
    protected $total;
    protected $content;
    
    // Voucher properties
    public $voucherData = null;
    public $voucherDiscount = 0;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        // init origin
        $originRegionId = config('irfa.rajaongkir.origin_region_id');
        $this->originSubdistrict = ModelRegion::where('region_id', $originRegionId)->first()->subdistrict_ro;

        $this->total = Cart::total();
        $this->content = Cart::content();
        
        // Load voucher from cart
        $this->voucherData = Cart::getVoucher();
        $this->voucherDiscount = $this->calculateVoucherDiscount();

        // Initialize region only if user is authenticated and has an address
        if (auth()->check() && auth()->user()->user_address) {
            $regionId = auth()->user()->user_address->region_id;
            $this->userRegion = ModelRegion::where('region_id', $regionId)->where('subdistrict_ro', '<>', 'NULL')->first();
        } else {
            // For guests or users without address, no default region - they must select
            $this->userRegion = null;
        }
        $this->updateCart();
        $this->districtList = [];
        $this->subdistrictList = [];
        $this->areaList = [];
        $this->postalCode = [];
        $this->currentUrl = url()->current();
        $this->note = Cart::getNotes();

        // Populate user data if authenticated
        if(auth()->check()){
            $user = auth()->user();
            $this->shippingEmail = $user->email;
            $this->shippingFirstName = $user->first_name;
            $this->shippingLastName = $user->last_name;
            if($user->user_address && $this->userRegion) {
                $this->selectedProvince = $this->userRegion->province;
                $this->selectedDistrict = $this->userRegion->district;
                $this->selectedSubdistrict = $this->userRegion->subdistrict_ro; //unused but safety for not updating data
                $this->shippingAddress = $user->user_address->address;
                $this->shippingPhoneNumber = $user->user_address->phone_number;
                $this->updateDistrict($this->userRegion->province);
                $this->updateSubdistrict($this->userRegion->district);
                $this->updateArea($this->userRegion->subdistrict);
                $this->selectedArea = $this->userRegion->region_id;
                $this->shippingZipCode = $this->userRegion->post_code;
            }
        } else {
            // For guests, populate email from voucher data if available
            if ($this->voucherData && isset($this->voucherData['email'])) {
                $this->shippingEmail = $this->voucherData['email'];
            }
        }
        
        // Set shipping weight for both guest and authenticated users
        $this->shippingWeight = Cart::totalWeight();
        
        $this->filterCourierService();
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
        
        // Save or update user address if checkbox is checked and user is logged in
        if ($this->saveAddress && auth()->check()) {
            $existingAddress = UserAddress::where('user_id', auth()->user()->id)->first();
            
            $addressData = [
                'user_id' => auth()->user()->id,
                'region_id' => $this->selectedArea,
                'address' => $this->shippingAddress,
                'phone_number' => $this->shippingPhoneNumber,
            ];
            
            if ($existingAddress) {
                // Update existing address
                $existingAddress->update($addressData);
            } else {
                // Create new address
                UserAddress::create($addressData);
            }
        }
        
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

    public function setSelectedPaymentGateway($value)
    {
        $this->selectedPaymentGateway = $value;
    }

    public function paymentStepSubmit()
    {
        // updated orderID to prevent race condition on same seconds
        $orderID = Str::upper('SNK-'.time().'-'.Str::random(4));
        $items = [];
        $totalQuantity = 0;
        foreach(Cart::content() as $item) {
            $price = $item['retail_price'];
            if($item['discount_price'] != 0){
                $price = $item['discount_price'];
            }

            $items[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $price,
                'category' => 'shoes',
                'url' => $item['url']
            ];

            $totalQuantity += $item['quantity'];
        }
        
        // Add voucher discount as a line item (if applied)
        if ($this->voucherDiscount > 0) {
            $items[] = [
                'id'       => 'VOUCHER_DISCOUNT',
                'name'     => 'Voucher Discount (' . ($this->voucherData['code'] ?? '') . ')',
                'quantity' => 1,
                'price'    => -intval($this->voucherDiscount), // Negative amount for discount
                'category' => 'discount',
                'url'      => null
            ];
        }
        
        // Add shipping as an item (moved outside loop - was a bug)
        if ($this->shippingCost > 0) {
            $items[] = [
                'id'       => 'SHIPPING',
                'name'     => 'Shipping Fee',
                'quantity' => 1,
                'price'    => intval($this->shippingCost),
                'category' => 'shipping',
                'url'      => null
            ];
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

        $params = [
            'transaction_details' => [
                'order_id' => $orderID,
                'gross_amount'  => intval($this->grandTotal),
            ],
            'customer_details' => [
                'first_name'    => $this->shippingFirstName,
                'last_name'     => $this->shippingLastName,
                'email'         => $this->shippingEmail,
                'phone'         => $this->shippingPhoneNumber,
                'billing_address' => [
                    'first_name'   => $this->shippingFirstName,
                    'last_name'    => $this->shippingLastName,
                    'address'      => $this->shippingAddress,
                    'city'         => $this->shippingDistrict,
                    'postal_code'  => $this->shippingZipCode,
                    'phone'        => $this->shippingPhoneNumber,
                    'country_code' => 'IDN',
                ],
                'shipping_address' => [
                    'first_name'   => $this->shippingFirstName,
                    'last_name'    => $this->shippingLastName,
                    'address'      => $this->shippingAddress,
                    'city'         => $this->shippingDistrict,
                    'postal_code'  => $this->shippingZipCode,
                    'phone'        => $this->shippingPhoneNumber,
                    'country_code' => 'IDN',
                ]
            ],
            'item_details' => $items,
            'callbacks' => [
                'error'  => route('customer.payment.error'),
                'finish' => route('customer.payment.success', $orderID),
                'sucess' => route('customer.payment.success', $orderID),
            ],
            'custom_field1' => 'Gateway: Midtrans', // optional metadata
            'custom_field2' => Cart::getNotes() ?? '',
        ];

        // Get voucher data from cart
        $voucherData = Cart::getVoucher();
        
        $transactions = [
            'transactions' => [
                'date'            => date('Y-m-d'),
                'gateway'         => 'Midtrans',
                'total_quantity'  => $totalQuantity,
                'total_weight'    => Cart::totalWeight(),
                'sub_total'       => Cart::total(),
                'description'     => Cart::getNotes(),
                'grand_total'     => $this->grandTotal,
                'discount_voucher_id' => $voucherData['id'] ?? null,
                'voucher_code'    => $voucherData['code'] ?? null,
                'voucher_discount' => $voucherData ? $this->calculateVoucherDiscount($voucherData, Cart::total()) : null,
            ],

            'transaction_destinations' => [
                'region_id'    => $this->selectedArea,
                'email'        => $this->shippingEmail,
                'first_name'   => $this->shippingFirstName,
                'last_name'    => $this->shippingLastName,
                'address'      => $this->shippingAddress,
                'phone_number' => $this->shippingPhoneNumber,
                'is_user'      => auth()->check() ? 1 : 0,
                'user_id'      => auth()->user()->id ?? null,
            ],

            'transaction_items' => [
                'items' => Cart::content(),
            ],

            'transaction_shippings' => [
                'courier_code'       => Str::lower($this->selectedCourier['courier']),
                'shipping_method'    => $this->selectedCourier['courier'].' '.$this->selectedCourier['service'].' '.$shipping_etd,
                'shipping_cost'      => $this->selectedCourier['cost'],
                'shipping_weight'    => $this->shippingWeight,
                'origin_ro_id'       => config('irfa.rajaongkir.origin_region_id'),
                'destination_ro_id'  => $this->selectedSubdistrict,
            ],
        ];


        $paymentUrl = CheckoutMidtrans::createInvoiceMidtrans($params,$transactions);
        
        // Clear cart after order is created (for both guests and registered users)
        Cart::clear();
        
        return redirect()->away($paymentUrl);
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
        // Calculate grand total: cart total - voucher discount + shipping
        $subtotal = intval($cartTotal);
        $this->grandTotal = $subtotal - $this->voucherDiscount + intval($value);
        
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
        $regionData = ModelRegion::where('post_code', $value)->first();
        $this->selectedArea = $regionData->region_id;
    }

    public function updateArea($value) {
        $this->shippingSubDistrict = $value;
        $getDistrict = ModelRegion::where(['district' => $this->selectedDistrict, 'subdistrict' => $value])->first();
        if($getDistrict) {
            // V1 uses subdistrict / city RO
            // if($getDistrict->subdistrict_ro){
            //     $this->selectedSubdistrict = $getDistrict->subdistrict_ro;
            //     $destinationType = 'subdistrict';
            // } else {
            //     $this->selectedSubdistrict = $getDistrict->city_ro;
            //     $destinationType = 'city';
            // }

            // V2 uses region_id
            $this->selectedSubdistrict = $getDistrict->region_id;
            $this->filterCourierService();

            $this->areaList = ModelRegion::where('subdistrict', $value)->get()->pluck('area','region_id');
            $this->postalCode = ModelRegion::selectRaw('DISTINCT(post_code)')->where('subdistrict', $value)->orderBy('post_code')->get()->pluck('post_code');
            $this->selectedArea = 0;
            $this->shippingZipCode = '';
        }
    }

    public function areaUpdate($value) {
        $regionData = ModelRegion::where('region_id', $value)->first();
        $this->selectedArea = $value;
        $this->shippingZipCode = $regionData->post_code;
        $this->shippingArea = $regionData->area;
    }

    public function filterCourierService()
    {
        // Get enabled couriers and their services from database
        if($this->selectedSubdistrict) {
            $enabledCouriers = ShippingCourier::where('is_active', true)
                ->pluck('code')
                ->implode(':');
            $courier = CekOngkir::CostCourier($this->selectedSubdistrict, '', Cart::totalWeight(), $enabledCouriers);
            $courierResponse = CekOngkir::CostRangeCourier($courier);

            // Filter services based on what's configured for each courier
            $this->shippingCourier = $courierResponse->map(function($courierData) {
                $courier = ShippingCourier::where('code', strtolower($courierData['code']))->first();
                if (!$courier) {
                    return null;
                }

                // normalize "day / days" from response
                $courierData['etd'] = trim(preg_replace('/\s*days?/i', '', $courierData['etd']));

                // Get active service codes for this courier
                $activeServiceCodes = $courier->activeServices()->pluck('code')->toArray();

                // Filter services that are configured and active
                if (in_array($courierData['service'], $activeServiceCodes)) {
                    return $courierData;
                }
                return null;
            })->filter()->values();
        } else {
            $this->selectedSubdistrict = 0;
        }
    }

    /**
     * Calculate voucher discount amount
     * 
     * @param array|null $voucherData Voucher data (uses $this->voucherData if null)
     * @param int|null $subtotal Subtotal amount (uses $this->total if null)
     * @return int The discount amount
     */
    protected function calculateVoucherDiscount($voucherData = null, $subtotal = null)
    {
        $voucher = $voucherData ?? $this->voucherData;
        $amount = $subtotal ?? $this->total;
        
        if (!$voucher) {
            return 0;
        }
        
        if ($voucher['discount_type'] === 'percent') {
            $discount = ($amount * $voucher['discount_rate']) / 100;
            
            // Apply max discount cap if set
            if (isset($voucher['discount_amount']) && $voucher['discount_amount'] > 0 && $discount > $voucher['discount_amount']) {
                $discount = $voucher['discount_amount'];
            }
            
            return $discount;
        } else {
            return $voucher['discount_amount'];
        }
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
