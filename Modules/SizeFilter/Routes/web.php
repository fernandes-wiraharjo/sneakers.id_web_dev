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

Route::group(['prefix' => 'administrator/master-data/size-filter', 'middleware' => 'auth'], function() {
    Route::get('/', 'SizeFilterController@index')->name('administrator.master-data.size-filter.index');
    Route::get('/create', 'SizeFilterController@create')->name('administrator.master-data.size-filter.create');
    Route::get('/show/{id}', 'SizeFilterController@show')->name('administrator.master-data.size-filter.show');
    Route::get('/edit-{id}', 'SizeFilterController@edit')->name('administrator.master-data.size-filter.edit');
    Route::delete('/destroy/{id}', 'SizeFilterController@destroy')->name('administrator.master-data.size-filter.destroy');
    Route::post('/store', 'SizeFilterController@store')->name('administrator.master-data.size-filter.store');
    Route::put('/update/{id}', 'SizeFilterController@update')->name('administrator.master-data.size-filter.update');
});
