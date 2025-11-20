<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PostOTPController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:global'])->group(function() {
    Route::middleware('auth')
        ->group(function (){
            Route::get('/', fn () => redirect()->route('dashboard'));
            Route::view('/dashboard', 'dashboard')
                ->name('dashboard');
            Route::view('/home', 'home')
                ->name('home');
            Route::view('/forum', 'forum')
                ->name('forum');
            Route::get('/user/{user}', [UserController::class, 'show'])
                ->name('user.profile');
            Route::post('/user/{user}/update', [UserController::class, 'update'])
                ->name('user.update');
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

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

Route::fallback(function() {
    return response()->view('404', [], 404);
});

