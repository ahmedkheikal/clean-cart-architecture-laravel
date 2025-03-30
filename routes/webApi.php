<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    // Cart Resource
    Route::prefix('carts')->group(function () {
        Route::get('/current', [CartController::class, 'show']);          // Get current cart
        Route::post('/current/items', [CartController::class, 'addItem']); // Add item to cart
        Route::post('/current/checkout', [CartController::class, 'checkout']); // Process checkout
        Route::delete('/current/items/{itemId}', [CartController::class, 'removeItem']); // Remove item from cart
    });

    // Authentication Resource
    Route::prefix('auth')->group(function () {
        Route::get('/register', [RegisterController::class, 'register']);
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('/logout', [LogoutController::class, 'logout'])->middleware('auth:api');
    });

    // Product Resource
    Route::apiResource('products', ProductController::class)->only([
        'index',  // GET /products
        'show'    // GET /products/{id}
    ]);

    // Order Resource
    Route::apiResource('orders', OrderController::class)
        ->middleware('auth:api')
        ->only([
            'index',  // GET /orders
            'show',   // GET /orders/{id}
        ]);

    // Admin Resources
    Route::prefix('admin')->middleware('auth:api')->group(function () {
        Route::get('/dashboard', 'Admin\DashboardController@index');
        
        // Admin Product Resource
        Route::apiResource('products', 'Admin\ProductController')->names([
            'index' => 'admin.products.index',
            'show' => 'admin.products.show',
            'store' => 'admin.products.store',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);

        // Admin Order Resource
        Route::apiResource('orders', 'Admin\OrderController')->names([
            'index' => 'admin.orders.index',
            'show' => 'admin.orders.show',
            'update' => 'admin.orders.update',
        ]);

        // Admin User Resource
        Route::apiResource('users', 'Admin\UserController')->names([
            'index' => 'admin.users.index',
            'show' => 'admin.users.show',
            'update' => 'admin.users.update',
        ]);
    });
});
