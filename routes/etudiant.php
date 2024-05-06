<?php

use App\Http\Controllers\Etudiant\EtudiantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('etudiant')->group(static function () {

    // Guest routes
    Route::middleware('guest:etudiant')->group(static function () {
        // Auth routes
        Route::get('login', [\App\Http\Controllers\Etudiant\Auth\AuthenticatedSessionController::class, 'create'])->name('etudiant.login');
        Route::post('login', [\App\Http\Controllers\Etudiant\Auth\AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [\App\Http\Controllers\Etudiant\Auth\PasswordResetLinkController::class, 'create'])->name('etudiant.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Etudiant\Auth\PasswordResetLinkController::class, 'store'])->name('etudiant.password.email');
        // Reset password
        Route::get('reset-password/{token}', [\App\Http\Controllers\Etudiant\Auth\NewPasswordController::class, 'create'])->name('etudiant.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Etudiant\Auth\NewPasswordController::class, 'store'])->name('etudiant.password.update');
    });

    // Verify email routes
    Route::middleware(['auth:etudiant'])->group(static function () {
        Route::get('verify-email', [\App\Http\Controllers\Etudiant\Auth\EmailVerificationPromptController::class, '__invoke'])->name('etudiant.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Etudiant\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('etudiant.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Etudiant\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('etudiant.verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:etudiant'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [\App\Http\Controllers\Etudiant\Auth\ConfirmablePasswordController::class, 'show'])->name('etudiant.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Etudiant\Auth\ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::get('logout', [\App\Http\Controllers\Etudiant\Auth\AuthenticatedSessionController::class, 'destroy'])->name('etudiant.logout');
        // General routes
        Route::get('/', [\App\Http\Controllers\Etudiant\EtudiantController::class, 'index'])->name('etudiant.index');
        Route::get('profile', [\App\Http\Controllers\Etudiant\EtudiantController::class, 'profile'])->middleware('password.confirm.admin')->name('etudiant.profile');
        //Confirmation routes
        Route::get("/confirmation",[EtudiantController::class,"viewConfirmation"]);
        Route::Post("/confirmation",[EtudiantController::class,"PostConfirmation"])->name("etudiant.confirmation");
        Route::get("/ip",[EtudiantController::class,"ip"])->name("etudiant.ip");
        Route::get("/convocation",[EtudiantController::class,"convocation"])->name("etudiant.convocation");
        Route::get("/pdf_convocation",[EtudiantController::class,"pdfconvocation"])->name("etudiant.pdfconvocation");
        Route::get("/reclamtion_notes",[EtudiantController::class,"reclamationNote"])->name("etudiant.reclamationNote");
        Route::post("/reclamtion_notes",[EtudiantController::class,"reclamer"])->name("etudiant.reclamer");
        Route::post("/back_to_reclamer",[EtudiantController::class,"backtoreclamer"])->name("etudiant.backtoreclamer");
        //demandes
        Route::get("/demandes",[EtudiantController::class,"demandes"])->name("etudiant.demandes");
        Route::post("/demandes",[EtudiantController::class,"demander"])->name("etudiant.demander");
        Route::post("/deletedemande/{id}",[EtudiantController::class,"deletedemande"])->name("etudiant.deletedemande");
        Route::post("/back_to_demande",[EtudiantController::class,"backtodemande"])->name("etudiant.backtodemande");

});

});

