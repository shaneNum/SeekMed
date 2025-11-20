<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PostOTPController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function (){
    Route::get('/', fn () => redirect()->route('dashboard'));
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});


Route::middleware('guest')
    ->prefix('auth')
    ->group(function() {
        Route::view('/login', 'login')
            ->name('login');
        Route::post('/login', [LoginController::class, 'login'])
            ->name('login.post');
        Route::view('/register', 'register')
            ->name('register');
        Route::post('/register', [RegisterController::class, 'register'])
            ->name('register.post');
        Route::post('/verify-otp', [PostOTPController::class, 'verify'])
            ->name('verify-otp');
    });

    Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/api/doctors/search', [DashboardController::class, 'searchDoctors'])->name('api.doctors.search');
Route::get('/api/consultations', [DashboardController::class, 'consultations'])->name('api.consultations');
Route::get('/api/articles', [DashboardController::class, 'articles'])->name('api.articles');
});

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::fallback(function() {
    return response()->view('404', [], 404);
});

