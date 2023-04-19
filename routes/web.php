<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/signup');
});

Route::group(['controller' => RegisterController::class], function () {
    Route::get('/signup', 'create')->name('signup.create');
    Route::post('/signup', 'store')->name('signup.store');
    Route::get('/signup/verify', 'verify')->middleware('auth')->name('signup.verify');
    Route::get('/email/verify', 'verifying')->middleware('auth')->name('verification.notice');
});

Route::group(['controller' => SessionsController::class], function () {
    Route::get('login', 'create')->middleware('guest')->name('login.create');
    Route::post('login', 'store')->middleware('guest')->name('login.store');
    Route::get('logout', 'destroy')->middleware('auth')->name('logout.destroy');
});

Route::group(['controller' => ForgotPasswordController::class, 'middleware' => 'guest', 'prefix' => '/forgot-password'], function () {
    Route::get('/', 'email')->name('recover.email');
    Route::post('/', 'send')->name('recover.send');
    Route::view('/recover/verify', 'auth.verify')->name('recover.password.message');
    Route::get('/recover/{token}', 'password')->name('recover.password.create');
    Route::post('/reset-password', 'reset')->name('recover.password.reset');
});

Route::group([], function () {
    Route::view('email-verified', 'auth.verified', 
        ['message' => 'Your account is confirmed, you can sign in', 'redirect' => 'logout.destroy']
    )->middleware(['auth', 'verified'])->name('email.verified');

    Route::view('recover-verified', 'auth.verified', 
        ['message' => 'Your password has been updated successfully', 'redirect' => 'login.create']
    )->middleware('guest')->name('recover.verified');
});

Route::view('/test', 'auth.mail.verify-notice');

Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
