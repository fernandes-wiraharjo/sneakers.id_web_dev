<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVerify;

class DashboardController extends Controller {

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index() {
    if(auth()->user()->can('administrator.product.index')){
        return redirect(route('administrator.product.index'));
    } else {
        if (!auth()->user()->is_email_verified) {
            $verifyUser = UserVerify::where('user_id', Auth::user()->id)->first();
            $token = $verifyUser->token;

            if (!$token) {
                Auth::logout();

                return redirect()->route('customer.verify-email', $token)
                    ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            } else {
                return view('display-store.customer.dashboard', compact('token'));
            }
        } else {
            return view('display-store.customer.dashboard');
        }
    }
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
