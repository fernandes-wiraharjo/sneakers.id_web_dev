<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'administrator/master-data/top-text-carousel', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'TopTextCarouselController@index')->name('administrator.master-data.top-text-carousel.index');
    Route::get('/create', 'TopTextCarouselController@create')->name('administrator.master-data.top-text-carousel.create');
    Route::post('/store', 'TopTextCarouselController@store')->name('administrator.master-data.top-text-carousel.store');
    Route::get('/edit-{id}', 'TopTextCarouselController@edit')->name('administrator.master-data.top-text-carousel.edit');
    Route::put('/update/{id}', 'TopTextCarouselController@update')->name('administrator.master-data.top-text-carousel.update');
    Route::delete('/destroy/{id}', 'TopTextCarouselController@destroy')->name('administrator.master-data.top-text-carousel.destroy');
});
