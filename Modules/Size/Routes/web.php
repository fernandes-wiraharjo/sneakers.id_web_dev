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

Route::group(['prefix' => 'administrator/master-data/size', 'middleware' => 'auth'], function() {
    Route::get('/', 'SizeController@index')->name('administrator.master-data.size.index');
    Route::get('/create', 'SizeController@create')->name('administrator.master-data.size.create');
    Route::get('/show/{id}', 'SizeController@show')->name('administrator.master-data.size.show');
    Route::get('/edit-{id}', 'SizeController@edit')->name('administrator.master-data.size.edit');
    Route::delete('/destroy/{id}', 'SizeController@destroy')->name('administrator.master-data.size.destroy');
    Route::post('/store', 'SizeController@store')->name('administrator.master-data.size.store');
    Route::put('/update/{id}', 'SizeController@update')->name('administrator.master-data.size.update');
});
