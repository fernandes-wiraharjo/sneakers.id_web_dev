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

Route::group(['prefix' => 'administrator/transaction', 'middleware' => 'auth'], function() {
    Route::get('/', 'TransactionController@index')->name('administrator.transaction.index');
    Route::post('/update/resi-status', 'TransactionController@updateResi')->name('administrator.transaction.resi');
    Route::post('/check-resi', 'TransactionController@ajaxCheckResi')->name('administrator.transaction.cek-resi');
});
