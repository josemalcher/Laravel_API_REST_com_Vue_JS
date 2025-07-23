<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('products', ProductController::class);
/*
 * Route::controller(\App\Http\Controllers\API\ProductController::class)
    ->prefix('products')
    ->group(function () {
    Route::get('/', 'index');
    Route::get('/{product}', 'show');
    Route::post('/', 'store');
    Route::match(['put', 'patch'], '/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});
*/
