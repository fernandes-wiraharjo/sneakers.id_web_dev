<?php

namespace App\Http\Controllers\Administrator\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function redirectTo() {
        return redirect(route('customer.login'));
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('display-store.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        {
            $this->validate($request, $this->rules(), $this->validationErrorMessages());

            $response = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($response == 'passwords.token') {
                return redirect()->route('customer.forgot-password')->with(['token'=> 'Token mismatch, please resend email confirmation!']);
            }
            // dd(Password::PASSWORD_RESET);
            // Check the response to see if the password was successfully reset
            if ($response == Password::PASSWORD_RESET) {
                session()->flash('success', [
                   'Password Reset successfully please re-login.'
                ]);

                return redirect()->route('customer.login');
            } else {
                return redirect()->back()->with(['error' => 'something wrong please check your information']);
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

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker() {
        return Password::broker(config('ladmin.auth.broker', 'users'));
    }
}
