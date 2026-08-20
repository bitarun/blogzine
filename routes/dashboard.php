<?php

use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FileManagerController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware('role:admin|author')->name('dashboard');

    Route::resource('article', ArticleController::class);
    Route::put('article/{article}/status', [ArticleController::class, 'updateStatus'])->name('article.update-status');
    Route::resource('category', CategoryController::class, ['except' => ['index', 'show']]);
    Route::get('file-manager', [FileManagerController::class, 'index'])->name('file-manager.index');
    Route::post('file-manager', [FileManagerController::class, 'store'])->name('file-manager.store');
    Route::delete('file-manager', [FileManagerController::class, 'destroy'])->name('file-manager.destroy');

    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::post('users/register', [UserController::class, 'create']);
    Route::get('user/{user}/edit', [UserController::class, 'edit']);
    Route::put('user/{user}', [UserController::class, 'update']);
    Route::delete('user/{user}', [UserController::class, 'destroy']);
});
