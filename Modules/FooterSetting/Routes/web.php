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

Route::group(['prefix' => 'administrator/master-data/footer-setting', 'middleware' => 'auth'], function() {
    Route::get('/', 'FooterSettingController@index')->name('administrator.master-data.footer-setting.index');
    Route::post('/store', 'FooterSettingController@store')->name('administrator.master-data.footer-setting.store');
});
