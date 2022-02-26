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

Route::group(['prefix' => 'administrator/master-data/tag', 'middleware' => 'auth'], function() {
    Route::get('/', 'TagController@index')->name('administrator.master-data.tag.index');
    Route::get('/create', 'TagController@create')->name('administrator.master-data.tag.create');
    Route::get('/show/{id}', 'TagController@show')->name('administrator.master-data.tag.show');
    Route::get('/edit-{id}', 'TagController@edit')->name('administrator.master-data.tag.edit');
    Route::delete('/destroy/{id}', 'TagController@destroy')->name('administrator.master-data.tag.destroy');
    Route::post('/store', 'TagController@store')->name('administrator.master-data.tag.store');
    Route::put('/update/{id}', 'TagController@update')->name('administrator.master-data.tag.update');
});
