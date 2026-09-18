<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Facades\Cart;
use App\Facades\CekOngkir;
use App\Facades\CheckoutMidtrans;
use App\Models\Region as ModelRegion;
use App\Models\ShippingCourier;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Modules\DiscountVoucher\Repositories\DiscountVoucherRepository;

class CheckoutProcess extends Component
{
    public $currentStep = 1;
    public $successMessage = '';
    public $selectedCourier = [];
    public $selectedProvinceId = '';
    public $selectedCityId = '';
    public $selectedDistrictId = '';
    public $selectedSubdistrictId = 0;
    public $selectedPaymentGateway = null;

    public $shippingEmail = '';
    public $shippingFirstName = '';
    public $shippingLastName = '';
    public $shippingAddress = '';
    public $shippingPhoneNumber = '';
    public $shippingProvince = '';
    public $shippingCity = '';
    public $shippingDistrict = '';
    public $shippingSubdistrict = '';
    public $shippingZipCode = '';
    public $shippingCost = 0;
    public $shippingCourier = [];
    public $shippingWeight;

    public $cityList = [];
    public $districtList = [];
    public $subdistrictList = [];
    public $subdistrictRows = [];
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
    public $voucherEligible = true;
    public $voucherIneligibleMessage = '';
    
    // View type property to persist across Livewire updates
    public $useBootstrapView = false;

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        // Determine if we should use bootstrap view based on current URL or route
        $this->useBootstrapView = request()->routeIs('customer.checkout.order') 
            || str_contains(url()->current(), '/checkout/order')
            || str_contains(url()->current(), 'bootstrap');

        $this->total = Cart::total();
        $this->content = Cart::content();
        
        // Load voucher from cart
        $this->refreshVoucherState();

        $this->cityList = [];
        $this->districtList = [];
        $this->subdistrictList = [];
        $this->subdistrictRows = [];
        $this->currentUrl = url()->current();
        $this->note = Cart::getNotes();
        $this->shippingWeight = Cart::totalWeight();

        // Populate user data if authenticated
        if(auth()->check()){
            $user = auth()->user();
            $this->shippingEmail = $user->email;
            $this->shippingFirstName = $user->first_name;
            $this->shippingLastName = $user->last_name;

            if ($user->user_address) {
                $this->loadSavedAddress($user->user_address);
            }
        } elseif ($this->voucherData && isset($this->voucherData['email'])) {
            $this->shippingEmail = $this->voucherData['email'];
        }

        $this->updateCart();
        $this->filterCourierService();
    }

    protected function loadSavedAddress(UserAddress $address): void
    {
        $this->shippingAddress = $address->address;
        $this->shippingPhoneNumber = $address->phone_number;

        if ($address->province || $address->subdistrict_ro_id) {
            $this->shippingProvince = $address->province ?? '';
            $this->shippingCity = $address->city ?? '';
            $this->shippingDistrict = $address->district ?? '';
            $this->shippingSubdistrict = $address->subdistrict ?? '';
            $this->shippingZipCode = $address->postal_code ?? '';
            $this->selectedSubdistrictId = (int) ($address->subdistrict_ro_id ?? 0);
            $this->restoreLocationCascade();
            $this->filterCourierService();

            return;
        }

        if (! $address->region_id) {
            return;
        }

        $region = ModelRegion::where('region_id', $address->region_id)->first();
        if (! $region) {
            return;
        }

        $this->shippingProvince = $region->province;
        $this->shippingCity = $region->district;
        $this->shippingDistrict = $region->subdistrict;
        $this->shippingSubdistrict = $region->area;
        $this->shippingZipCode = $region->post_code;
        $this->selectedSubdistrictId = (int) $region->region_id;
        $this->filterCourierService();
    }

    protected function rules()
    {
        return [
            'shippingEmail' => 'required|email',
            'shippingFirstName' => 'required|min:1',
            'shippingLastName' => 'required|min:1',
            'shippingAddress' => 'required',
            'selectedProvinceId' => 'required',
            'selectedCityId' => 'required',
            'selectedDistrictId' => 'required',
            'selectedSubdistrictId' => 'required|gt:0',
            'shippingZipCode' => 'required',
            'shippingPhoneNumber' => 'required',
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
            'selectedProvinceId.required' => 'Provinsi untuk pengiriman harus dipilih.',
            'selectedCityId.required' => 'Kota/Kabupaten untuk pengiriman harus dipilih.',
            'selectedDistrictId.required' => 'Kecamatan untuk pengiriman harus dipilih.',
            'selectedSubdistrictId.required' => 'Kelurahan untuk pengiriman harus dipilih.',
            'selectedSubdistrictId.gt' => 'Kelurahan untuk pengiriman harus dipilih.',
            'shippingZipCode.required' => 'Kode pos untuk pengiriman harus diisi.',
            'shippingPhoneNumber.required' => 'Nomor telepon untuk pengiriman harus diisi.',
        ];
    }

    public function informationStepSubmit()
    {
        $this->validate();
        
        // Save or update user address if checkbox is checked and user is logged in
        if ($this->saveAddress && auth()->check()) {
            UserAddress::updateOrCreate(
                ['user_id' => auth()->user()->id],
                [
                    'region_id' => null,
                    'province' => $this->shippingProvince,
                    'city' => $this->shippingCity,
                    'district' => $this->shippingDistrict,
                    'subdistrict' => $this->shippingSubdistrict,
                    'postal_code' => $this->shippingZipCode,
                    'subdistrict_ro_id' => $this->selectedSubdistrictId,
                    'address' => $this->shippingAddress,
                    'phone_number' => $this->shippingPhoneNumber,
                ]
            );
        }

        $this->filterCourierService();

        $this->currentStep = 2;
        if (collect($this->shippingCourier)->count() === 0) {
            $this->back(1);
            $this->emit('modalMessage', ['message' => 'Mohon coba lagi, Ongkir gagal dibaca dari pihak ke-3']);
        }
    }

    public function shippingStepSubmit()
    {
        $this->refreshVoucherState();
        $this->currentStep = 3;
    }

    public function updatedCurrentStep($value)
    {
        if ((int) $value === 3) {
            $this->refreshVoucherState();
        }
    }

    public function setSelectedPaymentGateway($value)
    {
        if (! $this->voucherEligible) {
            return;
        }

        $this->selectedPaymentGateway = $value;
    }

    public function removeVoucher(): void
    {
        Cart::removeVoucher();
        $this->voucherData = null;
        $this->voucherDiscount = 0;
        $this->voucherEligible = true;
        $this->voucherIneligibleMessage = '';
        $this->selectedPaymentGateway = null;
        $this->recalculateGrandTotal();
    }

    public function paymentStepSubmit()
    {
        $this->refreshVoucherState();

        if (! $this->voucherEligible) {
            $this->selectedPaymentGateway = null;

            return;
        }

        // updated orderID to prevent race condition on same seconds
        $orderID = Str::upper('SNK-'.time().'-'.Str::random(4));
        $items = [];
        $totalQuantity = 0;

        foreach (Cart::content() as $item) {
            $price = $item['discount_price'] != 0 ? $item['discount_price'] : $item['retail_price'];

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

        $params = [
            'transaction_details' => [
                'order_id' => $orderID,
                'gross_amount'  => intval($this->grandTotal),
            ],
            'expiry' => [
                'start_time' => Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s').' +0700',
                'unit' => 'minutes',
                'duration' => (int) config('app.payment_ttl')
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
                    'city'         => $this->shippingCity,
                    'postal_code'  => $this->shippingZipCode,
                    'phone'        => $this->shippingPhoneNumber,
                    'country_code' => 'IDN',
                ],
                'shipping_address' => [
                    'first_name'   => $this->shippingFirstName,
                    'last_name'    => $this->shippingLastName,
                    'address'      => $this->shippingAddress,
                    'city'         => $this->shippingCity,
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
                'discount_voucher_id' => ($voucherData && $this->voucherEligible) ? ($voucherData['id'] ?? null) : null,
                'voucher_code'    => ($voucherData && $this->voucherEligible) ? ($voucherData['code'] ?? null) : null,
                'voucher_discount' => ($voucherData && $this->voucherEligible) ? $this->voucherDiscount : null,
            ],
            'transaction_destinations' => [
                'region_id'    => null,
                'province'     => $this->shippingProvince,
                'city'         => $this->shippingCity,
                'district'     => $this->shippingDistrict,
                'subdistrict'  => $this->shippingSubdistrict,
                'postal_code'  => $this->shippingZipCode,
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
                'destination_ro_id'  => $this->selectedSubdistrictId,
            ],
        ];

        $paymentUrl = CheckoutMidtrans::createInvoiceMidtrans($params, $transactions);

        if (empty($paymentUrl)) {
            $this->emit('modalMessage', [
                'message' => 'Pembayaran gagal dimulai. Periksa konfigurasi Midtrans atau coba lagi.',
            ]);

            return;
        }

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
        $this->shippingCost = $value;
        $this->selectedCourier = [
            'courier'   => $courier,
            'service'   => $service,
            'cost'      => $value,
            'etd'       => $etd
        ];
        $this->refreshVoucherState();
    }

    public function loadCities($provinceId)
    {
        $this->selectedProvinceId = $provinceId;
        $this->shippingProvince = CekOngkir::getProvinces()[$provinceId] ?? '';
        $this->cityList = CekOngkir::getCities($provinceId)->all();
        $this->selectedCityId = '';
        $this->selectedDistrictId = '';
        $this->selectedSubdistrictId = 0;
        $this->districtList = [];
        $this->subdistrictList = [];
        $this->subdistrictRows = [];
        $this->shippingCity = '';
        $this->shippingDistrict = '';
        $this->shippingSubdistrict = '';
        $this->shippingZipCode = '';
        $this->shippingCourier = collect();
    }

    public function loadDistricts($cityId)
    {
        $this->selectedCityId = $cityId;
        $this->shippingCity = $this->cityList[$cityId] ?? '';
        $this->districtList = CekOngkir::getDistricts($cityId)->all();
        $this->selectedDistrictId = '';
        $this->selectedSubdistrictId = 0;
        $this->subdistrictList = [];
        $this->subdistrictRows = [];
        $this->shippingDistrict = '';
        $this->shippingSubdistrict = '';
        $this->shippingZipCode = '';
        $this->shippingCourier = collect();
    }

    public function loadSubdistricts($districtId)
    {
        $this->selectedDistrictId = $districtId;
        $this->shippingDistrict = $this->districtList[$districtId] ?? '';
        $rows = CekOngkir::getSubdistricts($districtId);
        $this->subdistrictRows = $rows->keyBy('id')->all();
        $this->subdistrictList = $rows->pluck('name', 'id')->all();
        $this->selectedSubdistrictId = 0;
        $this->shippingSubdistrict = '';
        $this->shippingZipCode = '';
        $this->shippingCourier = collect();
    }

    public function selectSubdistrict($subdistrictId)
    {
        $subdistrictId = (string) $subdistrictId;
        $this->selectedSubdistrictId = (int) $subdistrictId;
        $row = $this->subdistrictRows[$subdistrictId] ?? null;
        $this->shippingSubdistrict = $row['name'] ?? ($this->subdistrictList[$subdistrictId] ?? '');
        $this->shippingZipCode = $row['zip_code'] ?? $this->shippingZipCode;
        $this->filterCourierService();
    }

    protected function restoreLocationCascade(): void
    {
        $provinceId = $this->findLocationId(CekOngkir::getProvinces(), $this->shippingProvince);
        if (! $provinceId) {
            return;
        }

        $this->selectedProvinceId = $provinceId;
        $this->cityList = CekOngkir::getCities($provinceId)->all();

        $cityId = $this->findLocationId(collect($this->cityList), $this->shippingCity);
        if (! $cityId) {
            return;
        }

        $this->selectedCityId = $cityId;
        $this->districtList = CekOngkir::getDistricts($cityId)->all();

        $districtId = $this->findLocationId(collect($this->districtList), $this->shippingDistrict);
        if (! $districtId) {
            return;
        }

        $this->selectedDistrictId = $districtId;
        $rows = CekOngkir::getSubdistricts($districtId);
        $this->subdistrictRows = $rows->keyBy('id')->all();
        $this->subdistrictList = $rows->pluck('name', 'id')->all();

        if ($this->selectedSubdistrictId) {
            return;
        }

        $subdistrictId = $this->findLocationId(collect($this->subdistrictList), $this->shippingSubdistrict);
        if ($subdistrictId) {
            $this->selectSubdistrict($subdistrictId);
        }
    }

    protected function findLocationId($items, ?string $name): ?string
    {
        if (! $name) {
            return null;
        }

        foreach ($items as $id => $label) {
            if (strcasecmp((string) $label, (string) $name) === 0) {
                return (string) $id;
            }
        }

        return null;
    }

    public function filterCourierService()
    {
        if ($this->selectedSubdistrictId) {
            $enabledCouriers = ShippingCourier::where('is_active', true)
                ->pluck('code')
                ->implode(':');

            if ($enabledCouriers === '') {
                $this->shippingCourier = collect();

                return;
            }

            $courier = CekOngkir::CostCourier($this->selectedSubdistrictId, '', Cart::totalWeight(), $enabledCouriers);
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

                if (in_array($courierData['service'], $activeServiceCodes)) {
                    return $courierData;
                }

                return null;
            })->filter()->values();
        } else {
            $this->shippingCourier = collect();
        }
    }

    protected function refreshVoucherState(): void
    {
        $this->voucherData = Cart::getVoucher();
        $this->voucherEligible = true;
        $this->voucherIneligibleMessage = '';
        $this->voucherDiscount = 0;

        if (! $this->voucherData) {
            $this->recalculateGrandTotal();

            return;
        }

        $email = $this->shippingEmail
            ?: ($this->voucherData['email'] ?? (auth()->user()->email ?? ''));
        $shippingCost = ($this->shippingCost > 0 || ! empty($this->selectedCourier))
            ? (float) $this->shippingCost
            : null;

        $result = app(DiscountVoucherRepository::class)->evaluateForCheckout(
            $this->voucherData['code'] ?? '',
            $email,
            (float) Cart::total(),
            $shippingCost
        );

        if (! $result['valid'] || (! $result['eligible'] && ! $result['pending'])) {
            $this->voucherEligible = false;
            $this->voucherIneligibleMessage = $result['message'];
            $this->selectedPaymentGateway = null;
            $this->recalculateGrandTotal();

            return;
        }

        if (! empty($result['pending'])) {
            $this->voucherDiscount = 0;
            $this->recalculateGrandTotal();

            return;
        }

        $this->voucherDiscount = $result['discount'];
        $this->recalculateGrandTotal();
    }

    protected function recalculateGrandTotal(): void
    {
        $this->grandTotal = max(
            0,
            intval(Cart::total()) - intval($this->voucherDiscount) + intval($this->shippingCost)
        );
    }

    /**
     * Calculate voucher discount amount
     */
    protected function calculateVoucherDiscount($voucherData = null, $subtotal = null)
    {
        $voucher = $voucherData ?? $this->voucherData;
        $amount = $subtotal ?? $this->total;

        if (! $voucher) {
            return 0;
        }

        $applyTo = $voucher['apply_to'] ?? 'cart';
        $shippingCost = ($this->shippingCost > 0 || ! empty($this->selectedCourier))
            ? (float) $this->shippingCost
            : 0;

        if ($applyTo === 'shipping') {
            $amount = $shippingCost;
        } elseif ($applyTo === 'cart') {
            $amount = (float) $amount + $shippingCost;
        }

        if ($amount < (float) ($voucher['min_purchase'] ?? 0)) {
            return 0;
        }

        if ($voucher['discount_type'] === 'percent') {
            $discount = ($amount * $voucher['discount_rate']) / 100;

            if (isset($voucher['discount_amount']) && $voucher['discount_amount'] > 0 && $discount > $voucher['discount_amount']) {
                $discount = $voucher['discount_amount'];
            }

            return min($discount, $amount);
        }

        return min((float) $voucher['discount_amount'], $amount);
    }

    public function render()
    {
        $province = CekOngkir::getProvinces()->all();
        $viewName = $this->useBootstrapView
            ? 'bootstrap.livewire.checkout-process'
            : 'livewire.checkout-process';

        return view($viewName, [
            'session_id' => Cart::hashID(),
            'total' => intval(Cart::total()),
            'content' => Cart::content(),
            'province' => $province,
            'note' => Cart::getNotes()
        ]);
    }
}
