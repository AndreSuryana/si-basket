<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RefereeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * User Authentication Routes
 */
Route::get('login', [AuthController::class, 'loginForm'])
    ->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'login'])
    ->middleware('guest')->name('postLogin');
Route::get('register', [AuthController::class, 'registerForm'])
    ->middleware('guest')->name('register');
Route::post('register', [AuthController::class, 'register'])
    ->middleware('guest')->name('postRegister');
Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')->name('logout');

    
/**
 * Main Routes
 */
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/', [MainController::class, 'dashboard'])
        ->name('dashboard');

    // Profile
    Route::get('profile', [MainController::class, 'formProfile'])
        ->name('profile');
    Route::post('profile', [MainController::class, 'profile'])
        ->name('postProfile');

    // Referee
    Route::prefix('referee')->group(function () {
        // Referee Data
        Route::get('data', [RefereeController::class, 'formData'])
            ->name('referee.data');
        Route::post('data', [RefereeController::class, 'data'])
            ->name('referee.postData');

        // Referee Event
        Route::get('event', [RefereeController::class, 'indexEvent'])
            ->name('referee.event');
        Route::get('event/add', [RefereeController::class, 'formEvent'])
            ->name('referee.formEvent');
        Route::post('event/add', [RefereeController::class, 'postEvent'])
            ->name('referee.postEvent');
        Route::get('event/{id}/edit', [RefereeController::class, 'formEditEvent'])
            ->name('referee.formEditEvent');
        Route::post('event/{id}/edit', [RefereeController::class, 'editEvent'])
            ->name('referee.editEvent');
        Route::post('event/{id}/delete', [RefereeController::class, 'deleteEvent'])
            ->name('referee.deleteEvent');

        // Referee License
        Route::get('license', [RefereeController::class, 'indexLicense'])
            ->name('referee.license');
        Route::get('license/add', [RefereeController::class, 'formLicense'])
            ->name('referee.formLicense');
        Route::post('license/add', [RefereeController::class, 'postLicense'])
            ->name('referee.postLicense');
        Route::get('license/{id}/edit', [RefereeController::class, 'formEditLicense'])
            ->name('referee.formEditLicense');
        Route::post('license/{id}/edit', [RefereeController::class, 'editLicense'])
            ->name('referee.editLicense');
        Route::post('license/{id}/delete', [RefereeController::class, 'deleteLicense'])
            ->name('referee.deleteLicense');
    });
});