<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/product', fn(\App\Models\Product $product) => $product->all());
Route::get('/product/{product}', fn(\App\Models\Product $product) => $product);
