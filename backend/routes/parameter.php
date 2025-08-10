<?php

use App\Http\Controllers\ParameterController;
use Illuminate\Support\Facades\Route;

Route::prefix('parameter')->group(function () {
    Route::get('/', [ParameterController::class, 'index']);
    Route::get('/{id}', [ParameterController::class, 'show']);
    Route::post('/store', [ParameterController::class, 'store']);
    Route::put('/{id}', [ParameterController::class, 'update']);
    Route::delete('/{id}', [ParameterController::class, 'destroy']);
});
