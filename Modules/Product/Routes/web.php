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

Route::group(['prefix' => 'administrator/product', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProductController@index')->name('administrator.product.index');
    Route::get('/create', 'ProductController@create')->name('administrator.product.create');
    Route::get('/show/{id}', 'ProductController@show')->name('administrator.product.show');
    Route::get('/edit-{id}', 'ProductController@edit')->name('administrator.product.edit');
    Route::delete('/destroy/{id}', 'ProductController@destroy')->name('administrator.product.destroy');
    Route::post('/store', 'ProductController@store')->name('administrator.product.store');
    Route::put('/update/{id}', 'ProductController@update')->name('administrator.product.update');
    Route::post('/upload-to-buckets', 'ProductController@uploadImagetoBuckets')->name('administrator.product.upload');
    Route::get('/read-files', 'ProductController@readFiles')->name('administrator.product.readfiles');
});
