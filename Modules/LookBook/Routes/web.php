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

Route::group(['prefix' => 'administrator/master-data/look-book', 'middleware' => 'auth'], function() {
    Route::get('/', 'LookBookController@index')->name('administrator.master-data.lookbook.index');
    Route::get('/create', 'LookBookController@create')->name('administrator.master-data.lookbook.create');
    Route::get('/show/{id}', 'LookBookController@show')->name('administrator.master-data.lookbook.show');
    Route::get('/edit-{id}', 'LookBookController@edit')->name('administrator.master-data.lookbook.edit');
    Route::delete('/destroy/{id}', 'LookBookController@destroy')->name('administrator.master-data.lookbook.destroy');
    Route::post('/store', 'LookBookController@store')->name('administrator.master-data.lookbook.store');
    Route::put('/update/{id}', 'LookBookController@update')->name('administrator.master-data.lookbook.update');
});
