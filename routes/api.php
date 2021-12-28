<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ======================================= Admin Route =======================================
// for banner =======================================================================
Route::apiResource('brands', BrandController::class);
Route::get('brands/{brand}/products', [BrandController::class, 'getProducts']);
// for category =======================================================================
Route::apiResource('category', CategoryController::class);
Route::get('category/{category}/products', [CategoryController::class, 'getProducts']);
Route::get('category/{category}/parent', [CategoryController::class, 'parent']);
Route::get('category/{category}/children', [CategoryController::class, 'children']);
// for product =======================================================================
Route::apiResource('product', ProductController::class);
Route::apiResource('product/gallery', ProductController::class);
