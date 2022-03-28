<?php

use Illuminate\Support\Facades\Route;
use Hexters\Ladmin\Routes\Ladmin;
use Hexters\Ladmin\Http\Controllers\LadminLogableController;
use App\Http\Controllers\StoreController;

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

Route::get('/product-detail/{id}', [StoreController::class, 'productDetail'])->name('product-detail');

Route::get('/collections/{filter}', [StoreController::class, 'collections'])->name('collections');

Route::get('/search', [StoreController::class, 'search'])->name('search');

Route::get('/lookbook/page/{page}', [StoreController::class, 'lookbook'])->name('lookbook');

Route::get('/size-chart', [StoreController::class, 'sizeChart'])->name('size-chart');

Route::get('/faq', [StoreController::class, 'faq'])->name('faq');

Route::get('/about-us', [StoreController::class, 'aboutUs'])->name('about-us');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Ladmin::route(function() {
    //Route::resource('/withdrawal', WithdrawalController::class); // Example
});

Route::group(['as' => 'system.', 'prefix' => 'system'], function() {
    //Route::resource('/log', LogController::class)->only(['index']);
    Route::resource('/activity', LadminLogableController::class)->only(['index', 'destroy']);
  });
