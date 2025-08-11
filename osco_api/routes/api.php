<?php

use App\Http\Controllers\pkg_Core\RestaurantController;
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