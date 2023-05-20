<?php

namespace App\Http\Controllers\Administrator\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\UserVerify;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hexters\Ladmin\Http\Middleware\LadminGuestMiddleware;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function redirectTo() {
        return '/' . config('ladmin.prefix', 'administrator');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->middleware([LadminGuestMiddleware::class])->except('logout');
        $this->repository = $repository;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('back-office.auth.login');
    }

        /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerLoginForm()
    {
        return view('display-store.auth.login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerRegisterForm()
    {
        return view('display-store.auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $token = Str::random(64);
        $request['role_id'] = 2;
        $request['remember_token'] = $token;

        $createUser = $this->repository->createUserCustomer($request);

        UserVerify::create([
              'user_id' => $createUser->id,
              'token' => $token
            ]);

        $notfiable = [
            'token' => $token,
            'request' => $request
        ];

        $sendMail = Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });

        return redirect(route("customer.login"))->with(['message'=> 'send email verification, pleace check your email to login!']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerForgotPasswordForm()
    {
        return view('display-store.auth.forgot-password');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerConfirmPasswordForm()
    {
        return view('display-store.auth.confirm-password');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerResetPasswordForm(Request $request, $token = null)
    {
        return view('display-store.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerVerifyEmailForm($token)
    {
        return view('display-store.auth.verify-email', compact('token'));
    }

    public function sendVerificationEmail($token){
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $update = $this->repository->updateEmailVerifiedAt($user->id);
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect()->route('customer.login')->with(['message'=> $message]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard(config('ladmin.auth.guard', 'web'))->logout();

        $request->session()->invalidate();

        return redirect()->route('store');
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
