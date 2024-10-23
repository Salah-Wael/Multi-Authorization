<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\Back\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/auth.php';

Route::prefix('/front')->name('front.')->group(function () {
    Route::get('/user', FrontHomeController::class)->middleware('auth')->name('index');
});

Route::prefix('/back')->name('back.')->group(function () {
    Route::get('/admin', BackHomeController::class)->middleware('auth')->name('index');

    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register')->middleware('guest');

    Route::post('register', [RegisteredUserController::class, 'store'])
    ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
});

Route::get('/', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
