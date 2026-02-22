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
    Route::post('/sync-from-transactions', 'ReportPurchaseController@syncFromTransactions')->name('administrator.report-purchase.sync-from-transactions');
});

Route::group(['prefix' => 'administrator/master-data/transaction-type', 'middleware' => ['web', 'auth']], function () {
    Route::get('/', 'TransactionTypeController@index')->name('administrator.master-data.transaction-type.index');
    Route::get('/create', 'TransactionTypeController@create')->name('administrator.master-data.transaction-type.create');
    Route::post('/store', 'TransactionTypeController@store')->name('administrator.master-data.transaction-type.store');
    Route::get('/edit-{id}', 'TransactionTypeController@edit')->name('administrator.master-data.transaction-type.edit');
    Route::put('/update/{id}', 'TransactionTypeController@update')->name('administrator.master-data.transaction-type.update');
    Route::delete('/destroy/{id}', 'TransactionTypeController@destroy')->name('administrator.master-data.transaction-type.destroy');
});
