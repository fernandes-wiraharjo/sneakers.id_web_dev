<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/review/{token}', 'ExternalReviewPublicController@show')
    ->name('external-review.show');

Route::group(['prefix' => 'administrator/external-review', 'middleware' => 'auth'], function () {
    Route::get('/', 'ExternalReviewController@index')->name('administrator.external-review.index');
    Route::get('/create', 'ExternalReviewController@create')->name('administrator.external-review.create');
    Route::post('/store', 'ExternalReviewController@store')->name('administrator.external-review.store');
    Route::delete('/destroy/{id}', 'ExternalReviewController@destroy')->name('administrator.external-review.destroy');
    Route::get('/product-sizes/{productId}', 'ExternalReviewController@productSizes')->name('administrator.external-review.product-sizes');
});
