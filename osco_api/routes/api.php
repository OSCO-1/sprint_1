<?php

use App\Http\Controllers\pkg_Core\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'API is working!';
});


Route::get('/restaurant', [RestaurantController::class, 'show']);
Route::put('/restaurant', [RestaurantController::class, 'update']);
