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

Route::group(['prefix' => 'administrator/master-data/shipping-courier', 'middleware' => 'auth'], function() {
    Route::get('/', 'ShippingCourierController@index')->name('administrator.master-data.shipping-courier.index');
    Route::get('/create', 'ShippingCourierController@create')->name('administrator.master-data.shipping-courier.create');
    Route::get('/show/{id}', 'ShippingCourierController@show')->name('administrator.master-data.shipping-courier.show');
    Route::get('/edit-{id}', 'ShippingCourierController@edit')->name('administrator.master-data.shipping-courier.edit');
    Route::delete('/destroy/{id}', 'ShippingCourierController@destroy')->name('administrator.master-data.shipping-courier.destroy');
    Route::post('/store', 'ShippingCourierController@store')->name('administrator.master-data.shipping-courier.store');
    Route::put('/update/{id}', 'ShippingCourierController@update')->name('administrator.master-data.shipping-courier.update');
});
