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

Route::group(['prefix' => 'administrator/master-data/signature-player', 'middleware' => 'auth'], function() {
    Route::get('/', 'SignaturePlayerController@index')->name('administrator.master-data.signature-player.index');
    Route::get('/create', 'SignaturePlayerController@create')->name('administrator.master-data.signature-player.create');
    Route::get('/show/{id}', 'SignaturePlayerController@show')->name('administrator.master-data.signature-player.show');
    Route::get('/edit-{id}', 'SignaturePlayerController@edit')->name('administrator.master-data.signature-player.edit');
    Route::delete('/destroy/{id}', 'SignaturePlayerController@destroy')->name('administrator.master-data.signature-player.destroy');
    Route::post('/store', 'SignaturePlayerController@store')->name('administrator.master-data.signature-player.store');
    Route::put('/update/{id}', 'SignaturePlayerController@update')->name('administrator.master-data.signature-player.update');
});
