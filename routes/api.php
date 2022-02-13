<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =================================================== Default Route ===================================================
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// =================================================== Auth Route ===================================================
Route::middleware('guest')->post('/register', [AuthController::class, 'register']);
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/payment/store', [PaymentController::class, 'store']);
Route::post('/payment/verify', [PaymentController::class, 'verify']);
// =================================================== Admin Route ===================================================
Route::prefix('admin')
    // ->middleware(['auth:sanctum', CheckPermission::class . ':view-dashboard']) // by middleware
    ->middleware(['auth:sanctum', 'can:view-dashboard']) // by gate
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
