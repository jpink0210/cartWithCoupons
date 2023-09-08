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


// Auth Login
// Route::post('signup', 'AuthController@signup');

Route::controller(AuthController::class)->group(function () {
    Route::post('/signup', 'signup')->name('user.signup');
    Route::post('/login', 'login')->name('user.login');
    Route::get('/logout', 'logout')->name('user.logout');

});


Route::get('member/signup', function () {
    return view('member.signup');
})->name('page.signup');

Route::get('member/login', function () {
    return view('member.login');
})->name('page.login');

Route::get('member/dashboard', function () {
    return view('member.dashboard');
})->name('page.dashboard');

