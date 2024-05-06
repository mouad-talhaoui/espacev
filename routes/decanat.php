<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Decanat\Auth\NewPasswordController;
use App\Http\Controllers\Decanat\Auth\VerifyEmailController;
use App\Http\Controllers\Decanat\Auth\PasswordResetLinkController;
use App\Http\Controllers\Decanat\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Decanat\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Decanat\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Decanat\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Decanat\DecanatController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('decanat')->name("decanat.")->group(static function () {

    // Guest routes
    Route::middleware('guest:decanat')->group(static function () {
        // Auth routes
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        // Reset password
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    // Verify email routes
    Route::middleware(['auth:decanat'])->group(static function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:decanat'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // General routes
        Route::get('/', [DecanatController::class, 'index'])->name('index');
    Route::get('profile', [DecanatController::class, 'profile'])->middleware('password.confirm.decanat')->name('profile');
});

});

