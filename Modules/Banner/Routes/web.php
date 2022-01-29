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

Route::group(['prefix' => 'administrator/master-data/banner', 'middleware' => 'auth'], function() {
    Route::get('/', 'BannerController@index')->name('administrator.master-data.banner.index');
    Route::get('/create', 'BannerController@create')->name('administrator.master-data.banner.create');
    Route::get('/show/{id}', 'BannerController@show')->name('administrator.master-data.banner.show');
    Route::get('/edit/{id}', 'BannerController@edit')->name('administrator.master-data.banner.edit');
    Route::delete('/destroy/{id}', 'BannerController@destroy')->name('administrator.master-data.banner.destroy');
    Route::post('/store', 'BannerController@store')->name('administrator.master-data.banner.store');
    Route::put('/update/{id}', 'BannerController@update')->name('administrator.master-data.banner.update');
});
