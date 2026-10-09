<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\Api\V1\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api::v1.')->group(function () {
    Route::prefix('authentication')->name('auth.')->group(function () {
        Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::get('/me', [AuthenticationController::class, 'me'])->name('me');
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    });
    Route::prefix('orders')->group(function () {
        echo "test";
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'create'])->name('create');
    });
});
