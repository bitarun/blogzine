<?php


namespace App\Services;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ArticleIndexService
{
    private const BASIC_COLUMNS = [
        'id',
        'title',
        'slug',
        'thumbnails',
        'description',
        'created_at',
        'author_id',
        'category_id',
    ];

    /* ===================== Public Methods ===================== */

    public function getTrending(int $limit = 10): Collection
    {
        return $this->baseQuery($limit)
            ->latest('created_at')
            ->get(self::BASIC_COLUMNS);
    }

    public function getTopByLikes(int $limit = 8): Collection
    {
        return $this->baseQuery($limit)
            ->orderByDesc('likes')
            ->get(self::BASIC_COLUMNS);
    }

    public function getVideoArticles(int $limit = 4): array
    {
        $articles = $this->baseQuery($limit)
            ->where('type', 'multimedia')
            ->latest('created_at')
            ->get(self::BASIC_COLUMNS);

        return [
            'first' => $articles->get(0),
            'second' => $articles->get(1),
            'others' => $articles->slice(2),
        ];
    }

    public function getTechnologyArticles(int $limit = 10): Collection
    {
        return $this->getByCategory('Technology', $limit);
    }

    public function getSportsArticles(int $limit = 10): Collection
    {
        return $this->getByCategory('Sports', $limit);
    }

    public function getAdminsArticles(int $limit = 10): Collection
    {
        return $this->baseQuery($limit)
            ->whereHas('author', fn(Builder $q) => $q->where('role', 'admin'))
            ->get(self::BASIC_COLUMNS);
    }

    /* ===================== Private Methods ===================== */

    private function baseQuery($limit): Builder
    {
        return Article::query()
            ->with([
                'category:id,name,en_name',
                'author:id,name',
                'author.profile:id,user_id,avatar',
            ])
            ->limit($limit);
    }

    private function getByCategory(string $categoryEnName, int $limit): Collection
    {
        return $this->baseQuery($limit)
            ->whereHas('category', fn(Builder $q) => $q->where('en_name', $categoryEnName))
            ->inRandomOrder()
            ->get(self::BASIC_COLUMNS);
    }
}
