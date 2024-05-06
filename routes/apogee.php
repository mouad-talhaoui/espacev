<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apogee\ApogeeController;
use App\Http\Controllers\Apogee\ApoConvocation;
use App\Http\Controllers\Apogee\Auth\NewPasswordController;
use App\Http\Controllers\Apogee\Auth\VerifyEmailController;
use App\Http\Controllers\Apogee\Auth\PasswordResetLinkController;
use App\Http\Controllers\Apogee\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Apogee\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Apogee\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Apogee\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('apogee')->name("apogee.")->group(static function () {

    // Guest routes
    Route::middleware('guest:apogee')->group(static function () {
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
    Route::middleware(['auth:apogee'])->group(static function () {
        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:apogee'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        // General routes
        Route::get('/', [ApogeeController::class, 'index'])->name('index');
        Route::get('profile', [ApogeeController::class, 'profile'])->middleware('password.confirm.apogee')->name('profile');
        //gestion des filieres
        Route::get('filieres',[ApogeeController::class,"gestion_filieres"])->name('filieres');
        Route::post('store/filieres',[ApogeeController::class,"store_filieres"])->name('store.filieres');
        //gestion des étudiants
        Route::get('etudiants',[ApogeeController::class,"gestion_etudiants"])->name('etudiants');
        Route::post('store/etudiants',[ApogeeController::class,"store_etudiants"])->name('store.etudiants');
        //gestion des sections
        Route::get('sections',[ApogeeController::class,"gestion_sections"])->name('sections');
        Route::post('store/sections',[ApogeeController::class,"store_sections"])->name('store.sections');
        //gestion des modules
        Route::get('modules',[ApogeeController::class,"gestion_modules"])->name('modules');
        Route::post('store/modules',[ApogeeController::class,"store_modules"])->name('store.modules');
        //gestion des IP
        Route::get('ips',[ApogeeController::class,"gestion_ips"])->name('ips');
        Route::post('store/ips',[ApogeeController::class,"store_ips"])->name('store.ips');
         //gestion des locaux
         Route::get('local', [ApoConvocation::class, 'gestion_local'])->name('local');
         Route::post('store/local',[ApoConvocation::class,"store_local"])->name('store.local');
         //gestion des numerotations
        Route::get('numerotation', [ApoConvocation::class, 'gestion_nums'])->name('numerotation');
        Route::post('store/numerotation',[ApoConvocation::class,"store_nums"])->name('store.numerotation');
        //gestion des profs
        Route::get('profs', [ApoConvocation::class, 'gestion_profs'])->name('profs');
        Route::post('store/profs',[ApoConvocation::class,"store_profs"])->name('store.profs');
        //gestion des séances
        Route::get('seances', [ApoConvocation::class, 'gestion_seance'])->name('seances');
        Route::post('store/seances',[ApoConvocation::class,"store_seance"])->name('store.seances');
        //gestion des creneaux
        Route::get('creneau', [ApoConvocation::class, 'gestion_creneau'])->name('creneau');
        Route::post('store/creneau',[ApoConvocation::class,"store_creneau"])->name('store.creneau');
        //gestion planning
        Route::get('planning', [ApoConvocation::class, 'gestion_planning'])->name('planning');
        Route::post('store/planning',[ApoConvocation::class,"store_planning"])->name('store.planning');
        //gestion convocation
        Route::get('convocation', [ApoConvocation::class, 'gestion_convocation'])->name('convocation');
        Route::post('store/convocation',[ApoConvocation::class,"store_convocation"])->name('store.convocation');
        ///////////////////////////
        //parameters //////////////
        Route::get('confirmation',[ApogeeController::class,"confirmation"])->name('confirmation');
        //confirmation
        Route::post('checkconfirm', [ApogeeController::class, 'checkconfirm'])->name('checkconfirm');
        Route::get('/exportconfermation',[ApogeeController::class,"confirmation"])->name("exportConfirmation");
        //convocation
        Route::post('checkconvocation', [ApogeeController::class, 'checkconvocation'])->name('checkconvocation');
        //Parametre /checkreclamation_Note
        Route::post('checkreclamtionnote', [ApogeeController::class, 'checkreclamtionnote'])->name('checkreclamation');
        //reclamation des notes
        Route::get('notes', [ApogeeController::class, 'gestion_recl_notes'])->name('notes');
        Route::post('store/notes',[ApogeeController::class,"store_recl_notes"])->name('store.notes');
        //gestion attestation de reussite
        Route::get('attes', [ApoConvocation::class, 'gestion_attstation_reussite'])->name('attes');
        Route::post('store/attes',[ApoConvocation::class,"store_attstation_reussite"])->name('store.attes');
});

});

