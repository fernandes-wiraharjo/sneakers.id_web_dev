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


Route::group(['prefix' => 'administrator/master-data/global-setting', 'middleware' => 'auth'], function() {
    Route::get('/', 'GlobalSettingController@index')->name('administrator.master-data.global-setting.index');
    Route::get('/create', 'GlobalSettingController@create')->name('administrator.master-data.global-setting.create');
    Route::get('/show/{id}', 'GlobalSettingController@show')->name('administrator.master-data.global-setting.show');
    Route::get('/edit-{id}', 'GlobalSettingController@edit')->name('administrator.master-data.global-setting.edit');
    Route::delete('/destroy/{id}', 'GlobalSettingController@destroy')->name('administrator.master-data.global-setting.destroy');
    Route::post('/store', 'GlobalSettingController@store')->name('administrator.master-data.global-setting.store');
    Route::put('/update/{id}', 'GlobalSettingController@update')->name('administrator.master-data.global-setting.update');
});
