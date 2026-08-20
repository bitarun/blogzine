<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest', 'trafficStats'])->group(function () {
    Route::get('register', [RegisterController::class, 'index'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'register']);

    Route::get('login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('login', [LoginController::class, 'login']);

    Route::get('auth/{driver}/redirect', [SocialLoginController::class, 'redirect'])
        ->name('social-login');

    Route::get('auth/{driver}/callback', [SocialLoginController::class, 'callback'])
        ->name('social-login.callback');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'index'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'index'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
