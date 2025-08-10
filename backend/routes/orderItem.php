<?php
use App\Http\Controllers\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('order-item')->group(function () {
    Route::get('/order/{orderId}', [OrderItemController::class, 'index']); // clearer
    Route::get('/show/{id}', [OrderItemController::class, 'show']);        // no conflict
    Route::post('/store', [OrderItemController::class, 'store']);
    Route::put('/{id}', [OrderItemController::class, 'update']);
    Route::delete('/{id}', [OrderItemController::class, 'destroy']);
});

