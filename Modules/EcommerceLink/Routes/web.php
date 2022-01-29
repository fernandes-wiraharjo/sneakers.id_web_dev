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


Route::group(['prefix' => 'administrator/master-data/ecommerce-link', 'middleware' => 'auth'], function() {
    Route::get('/', 'EcommerceLinkController@index')->name('administrator.master-data.ecommerce-link.index');
    Route::get('/create', 'EcommerceLinkController@create')->name('administrator.master-data.ecommerce-link.create');
    Route::get('/show/{id}', 'EcommerceLinkController@show')->name('administrator.master-data.ecommerce-link.show');
    Route::get('/edit/{id}', 'EcommerceLinkController@edit')->name('administrator.master-data.ecommerce-link.edit');
    Route::delete('/destroy/{id}', 'EcommerceLinkController@destroy')->name('administrator.master-data.ecommerce-link.destroy');
    Route::post('/store', 'EcommerceLinkController@store')->name('administrator.master-data.ecommerce-link.store');
    Route::put('/update/{id}', 'EcommerceLinkController@update')->name('administrator.master-data.ecommerce-link.update');
});

