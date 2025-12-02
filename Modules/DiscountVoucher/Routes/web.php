<?php

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

Route::group(['prefix' => 'administrator/discount-voucher', 'middleware' => 'auth'], function() {
    Route::get('/', 'DiscountVoucherController@index')->name('administrator.discount-voucher.index');
    Route::get('/create', 'DiscountVoucherController@create')->name('administrator.discount-voucher.create');
    Route::get('/show/{id}', 'DiscountVoucherController@show')->name('administrator.discount-voucher.show');
    Route::get('/edit-{id}', 'DiscountVoucherController@edit')->name('administrator.discount-voucher.edit');
    Route::delete('/destroy/{id}', 'DiscountVoucherController@destroy')->name('administrator.discount-voucher.destroy');
    Route::post('/store', 'DiscountVoucherController@store')->name('administrator.discount-voucher.store');
    Route::put('/update/{id}', 'DiscountVoucherController@update')->name('administrator.discount-voucher.update');
});
