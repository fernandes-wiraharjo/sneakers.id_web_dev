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

use Modules\HeaderImage\Http\Controllers\HeaderImageController;

Route::prefix('administrator/master-data/header-image')
    ->name('administrator.master-data.header-image.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [HeaderImageController::class, 'index'])->name('index');
        Route::get('/create', [HeaderImageController::class, 'create'])->name('create');
        Route::get('/show/{id}', [HeaderImageController::class, 'show'])->name('show');
        Route::get('/edit-{id}', [HeaderImageController::class, 'edit'])->name('edit');
        Route::delete('/destroy/{id}', [HeaderImageController::class, 'destroy'])->name('destroy');
        Route::post('/store', [HeaderImageController::class, 'store'])->name('store');
        Route::put('/update/{id}', [HeaderImageController::class, 'update'])->name('update');
});

