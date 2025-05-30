<?php
use App\Http\Controllers\web\LoginController;
use App\Http\Controllers\web\UserController;
use Illuminate\Foundation\Application;

use Illuminate\Support\Facades\Route;

//------- Login & Logout -----
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'create')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.submit')->middleware('guest');
    Route::post('/logout', 'destroy')->name('logout')->middleware('auth');
});


//------- Creating Account ------
Route::controller(UserController::class)->group(function () {
    Route::get('/create-account', 'create')->name('register')->middleware('guest');
    Route::post('/create-account', 'store')->middleware('guest');
});

