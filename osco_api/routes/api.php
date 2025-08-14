<?php

use App\Http\Controllers\pkg_Core\RestaurantController;
use App\Http\Controllers\pkg_Menu\MenuCategoryController;
use App\Http\Controllers\pkg_Menu\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'API is working!';
});


Route::prefix('restaurant')->group(function () {
    Route::get('/', [RestaurantController::class, 'show']);

    // Single unified update endpoint
    Route::put('/', [RestaurantController::class, 'update']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [MenuCategoryController::class, 'index']);          // List all categories
    Route::post('/', [MenuCategoryController::class, 'store']);         // Create new category
    Route::get('/{id}', [MenuCategoryController::class, 'show']);       // Get single category
    Route::put('/{id}', [MenuCategoryController::class, 'update']);     // Update category
    Route::post('/{id}', [MenuCategoryController::class, 'update']);    // Update category (POST with _method=PUT)
    Route::delete('/{id}', [MenuCategoryController::class, 'destroy']); // Delete category

    // Reorder categories
    Route::post('reorder', [MenuCategoryController::class, 'reorder']);
});



Route::prefix('items')->group(function () {
    Route::get('/', [MenuItemController::class, 'index']);          // List all menu items
    Route::post('/', [MenuItemController::class, 'store']);         // Create new menu item
    Route::get('/filter/{categoryId}', [MenuItemController::class, 'filterByCategory']); // Get items by category
    Route::get('/{id}', [MenuItemController::class, 'show']);       // Get single menu item
    Route::put('/{id}', [MenuItemController::class, 'update']);     // Update menu item
    Route::post('/{id}', [MenuItemController::class, 'update']);    // Update menu item (POST with _method=PUT)
    Route::delete('/{id}', [MenuItemController::class, 'destroy']); // Delete menu item
});