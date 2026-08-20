<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menuCategories = Category::select(['name', 'en_name'])
                ->withCount('articles')
                ->get();

            $twoLatestArticles = Article::with(['author:id,name', 'category:id,name,en_name'])
                ->latest()
                ->limit(2)
                ->get(['id', 'title', 'author_id', 'category_id', 'slug', 'created_at']);

            $eventsPath = resource_path('data/events-1405.json');
            if (file_exists($eventsPath)) {

                $today = Verta::now()->format('Y-m-d');
                $events = json_decode(file_get_contents($eventsPath), true);
                $todayEventsCollection = collect($events)->firstWhere('date', $today);
                $todayEvents = $todayEventsCollection['events'] ?? [];

            } else {
                $todayEvents = [];
            }

            $view->with([
                'menuCategories' => $menuCategories,
                'twoLatestArticles' => $twoLatestArticles,
                'todayEvents' => $todayEvents,
            ]);
        });
    }
}
