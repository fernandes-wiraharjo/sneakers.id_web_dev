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

Route::group(['prefix' => 'administrator/master-data/faq', 'middleware' => 'auth'], function() {
    Route::get('/', 'FaqController@index')->name('administrator.master-data.faq.index');
    Route::get('/create', 'FaqController@create')->name('administrator.master-data.faq.create');
    Route::get('/show/{id}', 'FaqController@show')->name('administrator.master-data.faq.show');
    Route::get('/edit-{id}', 'FaqController@edit')->name('administrator.master-data.faq.edit');
    Route::delete('/destroy/{id}', 'FaqController@destroy')->name('administrator.master-data.faq.destroy');
    Route::post('/store', 'FaqController@store')->name('administrator.master-data.faq.store');
    Route::put('/update/{id}', 'FaqController@update')->name('administrator.master-data.faq.update');
});
