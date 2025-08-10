<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('restaurant')->group(function (){
    Route::get('/', [RestaurantController::class , 'index']);
    Route::get('/{id}', [RestaurantController::class , 'show']);
    Route::post('/store', [RestaurantController::class , 'store']);
    Route::put('/{id}', [RestaurantController::class , 'update']);
    Route::delete('/{id}', [RestaurantController::class , 'destroy']);
});
