<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware('trafficStats')->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('archive/{category}', [ArticleController::class, 'byCategory'])->name('archive');

    Route::get('article/show/{category:en_name}/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

    Route::middleware('ensureAjaxRequest')->group(function () {
        Route::any('/profile/personal', [ProfileController::class, 'updatePersonal']);
        Route::any('/profile/social-links', [ProfileController::class, 'updateSocialLinks']);
        Route::any('/profile/availability', [ProfileController::class, 'updateAvailability']);
        Route::any('/profile/password', [ProfileController::class, 'updatePassword']);
        Route::any('/profile/avatar', [ProfileController::class, 'deleteAvatar']);
        Route::get('archive/{category}/load', [ArticleController::class, 'loadMore']);
    });
});

Route::post('/comment/{article}', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

/*Auth Routes*/
require __DIR__.'/auth.php';

/*Dashboard Routes*/
require __DIR__.'/dashboard.php';
