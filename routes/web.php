<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CartController;


// Auth Login
// Route::post('signup', 'AuthController@signup');

Route::controller(AuthController::class)->group(function () {
    Route::post('/signup', 'signup')->name('user.signup');
    Route::post('/login', 'login')->name('user.login');

    Route::get('/logout', 'logout')->name('user.logout');

});


Route::get('member/signup', function () {
    return view('member.signup');
})->name('signup');

Route::get('member/login', function () {
    return view('member.login');
})->name('login');





Route::group(
    [
    'middleware' => 'auth'
],
    function () {

        Route::get('member/dashboard', function () {
            return view('member.dashboard');
        })->name('page.dashboard');

        Route::get('member/cart', [CartController::class, 'mycart'])->name('mycart');

        Route::get('mart', [ProductController::class, 'mart'])->name('mart');
        /**
         * testStore
         */
        Route::post('cart_items', [CartItemController::class, 'store'])->name('addCartItem');
        /**
         * testUpdate
         */
        Route::put('cart_items/{id}', [CartItemController::class, 'update'])->name('changeQuans');
        /**
         * testDestroy
         */
        Route::delete('cart_items/{id}', [CartItemController::class, 'destroy'])->name('rmCartItem');
        /**
         * testUpdateCoupon
         */
        Route::put('cart_items/mart_coupon/{id}', [CartItemController::class, 'updateCoupon'])->name('updateCoupon');
        /**
         * testDestroyCoupon
         */
        Route::put('cart_items/mart_coupon/remove/{id}', [CartItemController::class, 'destroyCoupon'])->name('destroyCoupon');

        
    }
);