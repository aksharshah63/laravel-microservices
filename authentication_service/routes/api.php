<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api::v1.')->group(function () {
    Route::prefix('authentication')->middleware('guest')->group(function () {
        Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthenticationController::class, 'me'])->name('me');
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    });
});
