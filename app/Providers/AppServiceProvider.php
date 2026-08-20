<?php

namespace App\Providers;

use App\Events\Registered;
use App\Events\Subscribed;
use App\Exceptions\CustomMethodNotAllowedHandler;
use App\Listeners\SendSubscribeEmail;
use App\Listeners\SendWelcomeEmail;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\FileManager\FileManagerRepository;
use App\Repositories\FileManager\FileManagerRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FileManagerRepositoryInterface::class, FileManagerRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ExceptionHandler::class, CustomMethodNotAllowedHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Vite::macro('image', fn(string $image) => $this->asset('resources/assets/images/' . $image));
    }
}
