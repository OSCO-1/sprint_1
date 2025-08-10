<?php

use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('menu-item')->group(function () {
    Route::get('/', [MenuItemController::class, 'index'])->name('menu-item.index');
    Route::get('/{id}', [MenuItemController::class, 'find'])->name('menu-item.find');
    Route::post('/store', [MenuItemController::class, 'store'])->name('menu-item.store');
    Route::get('/{id}/edit', [MenuItemController::class, 'edit'])->name('menu-item.edit');
    Route::put('/{id}', [MenuItemController::class, 'update'])->name('menu-item.update');
    Route::delete('/{id}', [MenuItemController::class, 'destroy'])->name('menu-item.destroy');
    Route::get('/filter/{category_id}', [MenuItemController::class, 'filterByCategory'])->name('menu-item.filter');
});
