<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleIndexService;
use App\Services\CurrencyApiService;

class IndexController extends Controller
{
    protected CurrencyApiService $currencyApiService;
    protected ArticleIndexService $articleIndexService;

    public function __construct(CurrencyApiService $currencyApiService, ArticleIndexService $articleIndexService)
    {
        $this->currencyApiService = $currencyApiService;
        $this->articleIndexService = $articleIndexService;
    }

    public function index()
    {
        //$currencyData = $this->currencyApiService->fetchCurrencyData();

        $trendingArticles = $this->articleIndexService->getTrending(5);
        $categories = Category::all();
        $topArticles = $this->articleIndexService->getTopByLikes(4);
        $videoArticles = $this->articleIndexService->getVideoArticles();
        $techArticles = $this->articleIndexService->getTechnologyArticles(5);
        $sportsArticles = $this->articleIndexService->getSportsArticles(5);
        $editorArticles = $this->articleIndexService->getAdminsArticles();

        return view('front.index', compact(
            'trendingArticles', 'categories',
            'topArticles', 'videoArticles', 'techArticles', 'sportsArticles', 'editorArticles'));
    }
}
