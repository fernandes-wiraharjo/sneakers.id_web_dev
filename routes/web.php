<?php

use Illuminate\Support\Facades\Route;
use Hexters\Ladmin\Routes\Ladmin;
use App\Http\Controllers\Administrator\LadminLogableController;
use App\Http\Controllers\Administrator\NotificationController;
use App\Http\Controllers\Administrator\DashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Administrator\Auth\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StoreController::class, 'index'])->name('store');

Route::get('/product-detail/{id}/{product_name}', [StoreController::class, 'productDetail'])->name('product-detail');

Route::get('/collections/{filter}', [StoreController::class, 'collections'])->name('collections');

Route::get('/search', [StoreController::class, 'search'])->name('search');

Route::get('/search-result/{keyword}', [StoreController::class, 'searchResult'])->name('search-result');

Route::get('/lookbook/page/{page}', [StoreController::class, 'lookbook'])->name('lookbook');

Route::get('/size-chart', [StoreController::class, 'sizeChart'])->name('size-chart');

Route::get('/faq', [StoreController::class, 'faq'])->name('faq');

Route::get('/about-us', [StoreController::class, 'aboutUs'])->name('about-us');
Route::get('/email', [StoreController::class, 'email'])->name('email');


Ladmin::route(function() {
    //Route::resource('/withdrawal', WithdrawalController::class); // Example
    Route::resource('/notification', NotificationController::class)->only(['index', 'show', 'store']);
});

Route::group(['as' => 'system.', 'prefix' => 'system'], function() {
    //Route::resource('/log', LogController::class)->only(['index']);
    Route::resource('/activity', LadminLogableController::class)->only(['index', 'destroy']);
});

//Customer
Route::get('/verify-email', [LoginController::class, 'showCustomerVerifyEmailForm'])->name('verification.notice');
Route::group(['as' => 'customer.', 'prefix' => 'customer'], function() {
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/login', [LoginController::class, 'showCustomerLoginForm'])->name('login');
    Route::get('/register', [LoginController::class, 'showCustomerRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'postRegistration'])->name('submit.register');
    Route::get('/forgot-password', [LoginController::class, 'showCustomerForgotPasswordForm'])->name('forgot-password');
    Route::get('/confirm-password', [LoginController::class, 'showCustomerConfirmPasswordForm'])->name('confirm-password');
    Route::get('/reset-password', [LoginController::class, 'showCustomerResetPasswordForm'])->name('reset-password');
    Route::get('/verify/{token}', [LoginController::class, 'showCustomerVerifyEmailForm'])->name('verify-email');
    Route::get('/verify-email/{token}', [LoginController::class, 'verifyAccount'])->name('user.verify');
    Route::get('/cart', [CartController::class, 'cartCheckout'])->name('cart');

    Route::group( ['middleware' => 'auth' ], function()
    {
        Route::post('/checkout/c/{hashID}/order', [CartController::class, 'createOrder'])->name('checkout.order');
        Route::post('/address/save', [DashboardController::class, 'saveAccount'])->name('address.save');
        Route::get('/success-payment/{external_id}', [CheckoutController::class, 'successPayments'])->name('payment.success');
        Route::get('/error-payment', [CheckoutController::class, 'errorPayments'])->name('payment.error');
        Route::get('/transaction/c/{external_id}', [DashboardController::class, 'detail'])->name('transaction.detail');
    });



});
