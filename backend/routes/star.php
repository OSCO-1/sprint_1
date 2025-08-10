<?php

use App\Http\Controllers\StarController;
use Illuminate\Support\Facades\Route;

Route::prefix('star')->group(function () {
    Route::get('/', [StarController::class, 'index']);
    Route::get('/{id}', [StarController::class, 'show']);
    Route::post('/store', [StarController::class, 'store']);
    Route::put('/{id}', [StarController::class, 'update']);
    Route::delete('/{id}', [StarController::class, 'destroy']);
});
