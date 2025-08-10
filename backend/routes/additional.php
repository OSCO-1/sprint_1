<?php

use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\AdditionalController;
use Illuminate\Support\Facades\Route;

Route::prefix('additional')->group(function () {
    Route::get('/', [AdditionalController::class, 'index']);
    Route::get('/{id}', [AdditionalController::class, 'show']);
    Route::post('/store', [AdditionalController::class, 'store']);
    Route::put('/{id}', [AdditionalController::class, 'update']);
    Route::delete('/{id}', [AdditionalController::class, 'destroy']);
});


