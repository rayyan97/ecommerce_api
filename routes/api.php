<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('App\Http\Controllers\Api')->group(function () {
    Route::post('register', [App\Http\Controllers\Api\RegisterController::class, 'register']);
    Route::post('login',  [App\Http\Controllers\Api\RegisterController::class, 'login']);

    Route::apiResource('product', ProductController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('cart', CartController::class);
        // Route::get('cart/total', [CartController::class, 'CartTotal']);
        Route::get('cart/increase/{id}', [App\Http\Controllers\Api\CartController::class, 'increaseQuantity']);
        Route::get('cart/decrease/{id}', [App\Http\Controllers\Api\CartController::class, 'decreaseQuantity']);
        Route::post('cart/coupon', [App\Http\Controllers\Api\CartController::class, 'verifyCoupon']);
        Route::get('pdfbill', [App\Http\Controllers\Api\CartController::class, 'generateBill']);
    });
});
