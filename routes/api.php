<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\categoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('brands', BrandController::class);
Route::apiResource('category', categoryController::class);
