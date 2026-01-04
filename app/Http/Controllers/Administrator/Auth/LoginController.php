<?php

namespace App\Http\Controllers\Administrator\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\UserVerify;
use App\Repositories\UserRepository;
use Modules\Brand\Repositories\BrandRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hexters\Ladmin\Http\Middleware\LadminGuestMiddleware;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Cache;

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

    public function __construct(UserRepository $repository, BrandRepository $brandRepository) {
        $this->middleware([LadminGuestMiddleware::class])->except(['logout', 'sendVerificationEmail', 'verifyAccount']);
        $this->repository = $repository;
        $this->brandRepository = $brandRepository;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('bootstrap.login');
    }

        /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerLoginForm()
    {
        return view('bootstrap.login');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerRegisterForm()
    {
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('bootstrap.register', $data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()],
            ]);

            $token = Str::random(64);
            $request['role_id'] = 2;
            $request['remember_token'] = $token;
            $request['name'] = $request->first_name.' '.$request->last_name;

            $createUser = $this->repository->createUserCustomer($request);

            UserVerify::create([
                'user_id' => $createUser->id,
                'token' => $token
                ]);

            $notfiable = [
                'token' => $token,
                'request' => $request
            ];

            // Log::info("Sending email to: " . $request->email);
            $sendMail = Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            // Log::info("Mail send result: ", ['result' => $sendMail]);

            // if (count(Mail::failures()) > 0) {
            //     Log::error('Mail failed: ', Mail::failures());
            // } else {
            //     Log::info('Mail sent successfully to ' . $request->email);
            // }

            return redirect()->route("customer.login")->with(['success'=> ['send email verification, pleace check your email to login!']]);
        } catch (ValidationException $e) {
            $errorMessage = 'Failed to register. ' . $e->getMessage();
            if ($e->errors()) {
                $errorMessage = 'Failed to register. ' . implode(' ', array_map(function($errors) {
                    return implode(' ', $errors);
                }, $e->errors()));
            }
            return back()->with(['toast_error' => $errorMessage])->withInput();
        } catch (\Exception $e) {
            // $mailPort = env('MAIL_PORT', 587);
            // Log::error("Regitration failed: (". $mailPort .") " . $e->getMessage());
            // return back()->with(['message' => 'Failed to register. ' . $e->getMessage()]);
            Log::error("Regitration failed: " . $e->getMessage());
        }
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerForgotPasswordForm()
    {
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.auth.forgot-password', $data);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerConfirmPasswordForm()
    {
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.auth.confirm-password', $data);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerResetPasswordForm(Request $request, $token = null)
    {
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.auth.reset-password', $data)->with(
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
        $data['token'] = $token;
        $data['brand_menu'] = $this->brandRepository->getActiveMenuBrand();
        $data['footer'] = Storage::disk('local')->exists('footer-setting.json') ? json_decode(Storage::disk('local')->get('footer-setting.json')) : [];
        return view('display-store.auth.verify-email', $data);
    }

    public function sendVerificationEmail($token){
        try {
            $verifyUser = UserVerify::where('token', $token)->first();
            if (!$verifyUser) {
                throw new \Exception('Token not found');
            }

            if ($verifyUser->user->is_email_verified) {
                return redirect()->back()->with('error', 'Your email is already verified.');
            }

            $sendMail = Mail::send('email.emailVerificationEmail', ['token' => $verifyUser->token], function($message) use($verifyUser){
                $message->to($verifyUser->user->email);
                $message->subject('Email Verification Mail');
            });
            if (count(Mail::failures()) > 0) {
                Log::error('Failed to send verification email: ' . json_encode(Mail::failures()));
                throw new \Exception('Failed to send verification email');
            }
            return redirect()->back()->with('success', 'Resend email verification, please check your email to verify.');

        } catch (\Exception $e) {
            Log::error("Failed to send verification email: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send verification email. Please try again later.');
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
                $verifyUser->user->remember_token = $token;
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
                return redirect()->route('customer.login')->with(['success'=> [$message]]);
            } else {
                $message = "Your e-mail is already verified. You can now login.";
                return redirect()->route('customer.login')->with(['success'=> [$message]]);
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

    public function checkActivity(Request $request)
    {
        if (Cache::has('user_last_activity:'.$request->userId)) {
            return response()->json(['is_active' => true]);
        } else {
            return response()->json(['is_active' => false]);
        }
    }
}
