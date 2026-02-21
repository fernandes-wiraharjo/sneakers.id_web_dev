<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('reporting')->group(function () {
    Route::get('/', 'ReportingController@index');
});

Route::group(['prefix' => 'administrator/report-purchase', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'ReportPurchaseController@index')->name('administrator.report-purchase.index');
    Route::get('/create', 'ReportPurchaseController@create')->name('administrator.report-purchase.create');
    Route::post('/store', 'ReportPurchaseController@store')->name('administrator.report-purchase.store');
    Route::get('/edit-{id}', 'ReportPurchaseController@edit')->name('administrator.report-purchase.edit');
    Route::put('/update/{id}', 'ReportPurchaseController@update')->name('administrator.report-purchase.update');
    Route::delete('/destroy/{id}', 'ReportPurchaseController@destroy')->name('administrator.report-purchase.destroy');
    Route::get('/typeahead-article', 'ReportPurchaseController@typeaheadArticle')->name('administrator.report-purchase.typeahead-article');
});
