<?php

use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu-category')->group(function () {
    Route::get('/', [MenuCategoryController::class, 'index']);
    Route::get('/{id}', [MenuCategoryController::class, 'show']);
    Route::post('/store', [MenuCategoryController::class, 'store']);
    Route::put('/{id}', [MenuCategoryController::class, 'update']);
    Route::delete('/{id}', [MenuCategoryController::class, 'destroy']);
});
