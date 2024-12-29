<?php

use App\Http\Controllers\V1\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->as('v1.')->group(function () {
    Route::prefix('customer-management')->as('customer-management.')->group(function () {
        Route::get('customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');
        Route::post('customer', [CustomerController::class, 'store'])->name('customer.create');
    });
});
