<?php

use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('front/')->name('front.')->group(function () {
    Route::get('/user', FrontHomeController::class)->middleware('auth')->name('index');
    Route::view('/login', 'front.auth.login');
    Route::view('/register', 'front.auth.register');
    Route::view('/forgot-password', 'front.auth.forgot-password');
});



require __DIR__.'/auth.php';
