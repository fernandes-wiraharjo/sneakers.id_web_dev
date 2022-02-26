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

Route::group(['prefix' => 'administrator/master-data/brand', 'middleware' => 'auth'], function() {
    Route::get('/', 'BrandController@index')->name('administrator.master-data.brand.index');
    Route::get('/create', 'BrandController@create')->name('administrator.master-data.brand.create');
    Route::get('/show/{id}', 'BrandController@show')->name('administrator.master-data.brand.show');
    Route::get('/edit-{id}', 'BrandController@edit')->name('administrator.master-data.brand.edit');
    Route::delete('/destroy/{id}', 'BrandController@destroy')->name('administrator.master-data.brand.destroy');
    Route::post('/store', 'BrandController@store')->name('administrator.master-data.brand.store');
    Route::put('/update/{id}', 'BrandController@update')->name('administrator.master-data.brand.update');
});
