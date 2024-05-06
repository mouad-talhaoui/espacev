<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fonctionnaire\FonctionnairController;
use App\Http\Controllers\Fonctionnaire\Auth\NewPasswordController;
use App\Http\Controllers\Fonctionnaire\Auth\VerifyEmailController;
use App\Http\Controllers\Fonctionnaire\Auth\PasswordResetLinkController;
use App\Http\Controllers\Fonctionnaire\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Fonctionnaire\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Fonctionnaire\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Fonctionnaire\Auth\EmailVerificationNotificationController;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('test',function(){
   echo(Hash::make(123456));
});

Route::prefix('fonctionnaire')->name("fonctionnaire.")->group(static function () {

    // Guest routes
    Route::middleware('guest:fonctionnaire')->group(static function () {
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
    Route::middleware(['auth:fonctionnaire'])->group(static function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:fonctionnaire'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // General routes
    Route::get('/', [FonctionnairController::class, 'index'])->name('index');
    Route::get('profile', [FonctionnairController::class, 'profile'])->middleware('password.confirm.fonctionnaire')->name('profile');
    Route::get('to_enatente', [FonctionnairController::class, 'enattente']);
    Route::post('to_enatente', [FonctionnairController::class, 'to_enatente'])->name("to_enatente");
    Route::post('/', [FonctionnairController::class, 'to_encour'])->name("to_encour");
    Route::get('refus', [FonctionnairController::class, 'refus'])->name("refus");
    Route::get('traite', [FonctionnairController::class, 'pret'])->name("pret");
    Route::post('/traite_bac/{id}', [FonctionnairController::class, 'traite_bac'])->name("traite_bac");
    Route::post('/retour_bac/{id}', [FonctionnairController::class, 'retour_bac'])->name("retour_bac");
    Route::post('/refus/{id}', [FonctionnairController::class, 'refus_bac'])->name("refus_bac");
    Route::get('/retour_bac', [FonctionnairController::class, 'retourbac'])->name("retourbac");
    Route::get('/bac_rp', [FonctionnairController::class, 'rp'])->name("rp");
    Route::get('/bac_rdc', [FonctionnairController::class, 'rdc'])->name("rdc");
    Route::post('/activer_bac', [FonctionnairController::class, 'activer_between'])->name("activer_between");
    Route::post('/activer_seul_bac/{id}', [FonctionnairController::class, 'activer_seul_bac'])->name("activer_seul_bac");
    Route::post('/bac_expiree', [FonctionnairController::class, 'bac_expiree'])->name("bac_expiree");
    Route::post('/excel_traite', [FonctionnairController::class, 'excel_traite'])->name("excel_traite");
    Route::post('/excel_diplome', [FonctionnairController::class, 'excel_diplome'])->name("excel_diplome");

});

});

