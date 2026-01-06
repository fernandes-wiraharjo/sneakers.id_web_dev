<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use Modules\Brand\Repositories\BrandRepository;
use Modules\Transaction\Entities\TransactionDestination;
use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVerify;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Storage;
use App\Facades\CekOngkir;
use Modules\Transaction\Entities\Transaction;

class DashboardController extends Controller {

    public $lastFiveDigitPhoneNumber;

    public function __construct(BrandRepository $brandRepository) {
            $this->brandRepository = $brandRepository;
    }
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index() {
      if(!auth()->check()) {
          return redirect()->route('customer.login')->with('error', 'Session has been expired, please re-login.');
      }
    // $resp = CekOngkir::CostCourier();
    // dump(CekOngkir::CostRangeCourier($resp));
    // dd($resp);
    if(auth()->user()->can('administrator.product.index')){
        return redirect(route('administrator.product.index'));
    }

    $data['transaction'] = TransactionDestination::with('transaction')->where('email', auth()->user()->email)->orderBy('created_at', 'DESC')->get();
    $data['user_address'] = auth()->user()->user_address()->first();
    $data['user_info'] = auth()->user();
    $data['region'] = Region::where('region_id', $data['user_address']->region_id ?? 18090)->first();
    $data['province'] = Region::selectRaw('DISTINCT(province)')->orderBy('province')->get()->pluck('province');

    if (!auth()->user()->is_email_verified) {
        $verifyUser = UserVerify::where('user_id', Auth::user()->id)->first();
        $token = $verifyUser->token;

        if (!$token) {
            Auth::logout();

            return redirect()->route('customer.verify-email', $token)
                ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }

        $data['token'] = $token;

        return view('bootstrap.customer-dashboard', $data);
    }

    return view('bootstrap.customer-dashboard', $data);
  }

    public function detail($external_id){
        // Anyone with the order token (hashID) can access the transaction details
        $transaction = Transaction::where('token', $external_id)->first();
        if(!$transaction){
            return redirect()->route('store')->with('error', 'Transaction not found.');
        }
        
        $transactionDestination = $transaction->destination()->first();
        if(!$transactionDestination){
            return redirect()->route('store')->with('error', 'Transaction destination not found.');
        }
        
        $lastFiveDigitPhoneNumber = substr(preg_replace('/[^0-9]/', '', $transactionDestination->phone_number), -5);
        $data = [
            'user' => auth()->user() ?? null,
            'transaction' => $transaction,
            'destination' => $transactionDestination,
            'region' => $transactionDestination->region()->first(),
            'items' => $transaction->items()->with('detail.product')->get(),
            'shipping' => $transaction->shipping()->first(),
            'shipping_waybill' => CekOngkir::CheckWaybill($transaction->shipping()->first()->shipping_waybill, $transaction->shipping()->first()->courier_code, $lastFiveDigitPhoneNumber) ?? null,
        ];
        return view('display-store.customer.transaction', $data);
    }

  public function saveAccount(Request $request) {

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required',
        'address' => 'required',
        'province' => 'required',
        'district' => 'required',
        'subdistrict' => 'required',
        'area' => 'required',
        'post_code' => 'required'
    ],[
        'first_name.required' => 'First Name is required',
        'last_name.required' => 'Last Name is required',
        'phone_number.reqired' => 'Phone Number is required',
        'address.required' => 'Address is required',
        'province.required' => 'Province is required',
        'district.required' => 'District is required',
        'subdistrict.required' => 'Subdistrict is required',
        'area.required' => 'Area is required',
        'post_code.required' => 'Post Code is required'
    ]);

    UserAddress::create([
        'user_id' => auth()->user()->id,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'region_id' => $request->area,
    ]);

    User::where('id', auth()->user()->id)->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'name' => $request->first_name.' '.$request->last_name
    ]);

    return redirect()->back()->with('success', 'Account Information Updated');
  }

      /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('ladmin.auth.guard', 'web'));
    }

}
