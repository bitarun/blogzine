<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Category $category, Article $article)
    {
        $article = $article->load(['category:id,name,en_name', 'author:id,name', 'author.profile:user_id,avatar,bio,social_links']);

        $categories = Category::withCount('articles')->get();

        $comments = $this->getComments($article);

        return view('front.articles.show', compact('article', 'categories', 'comments'));
    }

    public function byCategory(Category $category, $limit = 6)
    {
        $articles = $this->baseQuery($category->id, $limit)->get();

        return view('front.articles.by-category', compact('articles', 'category'));
    }

    public function loadMore(Category $category, Request $request)
    {
        $offset = $request->input('offset', 0);

        $articles = $this->baseQuery($category->id, 6)->skip($offset)->get();

        return ArticleResource::collection($articles);  //returns $data = {}
    }

    private function baseQuery(string $categoryID, $limit = 6)
    {
        return Article::with(['author:id,name', 'category:id,name,en_name'])
            ->where('category_id', $categoryID)
            ->limit($limit)
            ->latest('created_at');
    }

    private function getComments(Article $article)
    {
        return $article->comments()
            ->whereNull('parent_id')
            ->where(function (Builder $query) {
                $query->onlyApprovedOrOwner();
            })
            ->withReplies(2)
            ->with([
                'user:id,name',
                'user.profile:user_id,avatar',
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
