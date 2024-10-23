<?php

use App\Http\Controllers\Back\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Back\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Back\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Back\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Back\Auth\NewPasswordController;
use App\Http\Controllers\Back\Auth\PasswordController;
use App\Http\Controllers\Back\Auth\PasswordResetLinkController;
use App\Http\Controllers\Back\Auth\RegisteredUserController;
use App\Http\Controllers\Back\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('/back')->name('back.')->middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

});
