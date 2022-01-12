<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =================================================== Default Route ===================================================
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// =================================================== Auth Route ===================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// =================================================== Admin Route ===================================================
Route::prefix('admin')->middleware(['auth:sanctum', CheckPermission::class . ':view-dashboard'])
    ->group(static function () {
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
        Route::apiResource('product.gallery', GalleryController::class);
        // for role and permissions =======================================================================
        Route::apiResource('role', RoleController::class);
    });
