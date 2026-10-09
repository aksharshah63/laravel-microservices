<?php

use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api::v1.')->group(function () {
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'create'])->name('create');
    });
});
