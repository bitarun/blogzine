<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function get(string $sort, string $searchKey);
    public function store(array $validatedData): Article;
    public function update(array $validatedData, Article $article): bool;

    public function updateStatus(string $status, Article $article): bool;
    public function destroy(Article $article): bool;

    public function articleCountByType(array|string $types): Collection;

    public function articlesCount();
}
