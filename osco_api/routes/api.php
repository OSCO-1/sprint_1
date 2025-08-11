<?php

use App\Http\Controllers\pkg_Core\RestaurantController;
use App\Http\Controllers\pkg_Menu\MenuCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'API is working!';
});


Route::prefix('restaurant')->group(function () {
    Route::get('/', [RestaurantController::class, 'show']);

    Route::put('/basic-info', [RestaurantController::class, 'updateBasicInfo']);
    Route::put('/contact-info', [RestaurantController::class, 'updateContactInfo']);
    Route::put('/social-links', [RestaurantController::class, 'updateSocialLinks']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [MenuCategoryController::class, 'index']);          // List all categories
    Route::post('/', [MenuCategoryController::class, 'store']);         // Create new category
    Route::get('/{id}', [MenuCategoryController::class, 'show']);       // Get single category
    Route::put('/{id}', [MenuCategoryController::class, 'update']);     // Update category
    Route::delete('/{id}', [MenuCategoryController::class, 'destroy']); // Delete category

    // Reorder categories
    Route::post('/reorder', [MenuCategoryController::class, 'reorder']);
});