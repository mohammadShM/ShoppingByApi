<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ======================================= Admin Route =======================================
// for banner =======================================================================
Route::apiResource('brands', BrandController::class);
// for category =======================================================================
Route::apiResource('category', categoryController::class);
Route::get('category/{category}/parent', [categoryController::class, 'parent']);
Route::get('category/{category}/children', [categoryController::class, 'children']);
// for product =======================================================================
Route::apiResource('product', ProductController::class);
Route::apiResource('product/gallery', ProductController::class);
