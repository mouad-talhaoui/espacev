<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Professeur\ProfesseurController;
use App\Http\Controllers\Professeur\Auth\NewPasswordController;
use App\Http\Controllers\Professeur\Auth\VerifyEmailController;
use App\Http\Controllers\Professeur\Auth\PasswordResetLinkController;
use App\Http\Controllers\Professeur\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Professeur\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Professeur\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Professeur\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('professeur')->name("professeur.")->group(static function () {

    // Guest routes
    Route::middleware('guest:professeur')->group(static function () {
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
    Route::middleware(['auth:professeur'])->group(static function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:professeur'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // General routes
        Route::get('/', [ProfesseurController::class, 'index'])->name('index');
        //Reclamations des notes : show modules by sections
        Route::get('reclamations', [ProfesseurController::class, 'reclamations'])->name('reclamations');
        //Reclamations des notes by sections
        Route::get('/reclamation-list/{section}', [ProfesseurController::class, 'showReclamationList'])->name('reclamation.list');
});

});

