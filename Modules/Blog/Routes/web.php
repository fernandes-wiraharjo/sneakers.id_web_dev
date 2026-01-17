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

Route::prefix('blog')->group(function() {
    Route::get('/', 'BlogController@index');
});

Route::group(['prefix' => 'administrator/blog/category', 'middleware' => 'auth'], function() {
    Route::get('/', 'BlogCategoryController@index')->name('administrator.blog.category.index');
    Route::get('/create', 'BlogCategoryController@create')->name('administrator.blog.category.create');
    Route::get('/show/{id}', 'BlogCategoryController@show')->name('administrator.blog.category.show');
    Route::get('/edit-{id}', 'BlogCategoryController@edit')->name('administrator.blog.category.edit');
    Route::delete('/destroy/{id}', 'BlogCategoryController@destroy')->name('administrator.blog.category.destroy');
    Route::post('/store', 'BlogCategoryController@store')->name('administrator.blog.category.store');
    Route::put('/update/{id}', 'BlogCategoryController@update')->name('administrator.blog.category.update');
});
