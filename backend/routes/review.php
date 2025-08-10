<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('review')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::get('/{id}', [ReviewController::class, 'show']);
    Route::post('/store', [ReviewController::class, 'store']);
    Route::put('/{id}', [ReviewController::class, 'update']);
    Route::delete('/{id}', [ReviewController::class, 'destroy']);
});
