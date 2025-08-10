<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::post('/store', [OrderController::class, 'store']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});
