<?php

use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::prefix('tables')->group(function () {
    Route::get('/', [TableController::class, 'index']);
    Route::post('/store', [TableController::class, 'store']);
    Route::get('/{id}', [TableController::class, 'show']);
    Route::put('/update/{id}', [TableController::class, 'update']);
    Route::delete('/delete/{id}', [TableController::class, 'destroy']);
});
