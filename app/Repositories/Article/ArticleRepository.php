<?php

namespace App\Repositories\Article;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use LaravelIdea\Helper\App\Models\_IH_Article_QB;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function get(?string $sort, ?string $searchKey): LengthAwarePaginator
    {
        list($column, $direction) = $this->getSortOptions($sort);
        $query = $this->buildQuery();

        if ($searchKey) {
            $this->search($searchKey, $query);
        }

        return $query->orderBy($column, $direction)->paginate(12);
    }

    public function store(array $validatedData): Article
    {
        return Article::create($validatedData);
    }

    public function update(array $validatedData, Article $article): bool
    {
        return $article->update($validatedData);
    }

    public function updateStatus(string $status, Article $article): bool
    {
        return $article->update(['status' => $status]);
    }

    public function destroy(Article $article): bool
    {
        return $article->delete();
    }

    /**
     * @param string|null $sort
     * @return string[]
     */
    public function getSortOptions(?string $sort): array
    {
        $sortOptions = [
            'newest' => ['column' => 'created_at', 'direction' => 'desc'],
            'oldest' => ['column' => 'created_at', 'direction' => 'asc'],
            'popular' => ['column' => 'likes', 'direction' => 'desc'],
        ];

        $column = $sortOptions[$sort]['column'] ?? $sortOptions['newest']['column'];
        $direction = $sortOptions[$sort]['direction'] ?? $sortOptions['newest']['direction'];
        return array($column, $direction);
    }

    /**
     * @return Builder|_IH_Article_QB
     */
    public function buildQuery(): _IH_Article_QB|Builder
    {
        return Article::with(['author', 'category']);
    }

    /**
     * @param string $searchKey
     * @param Builder|_IH_Article_QB $query
     * @return void
     */
    public function search(string $searchKey, Builder|_IH_Article_QB $query): void
    {
        $searchKey = '%' . addcslashes($searchKey, '%_') . '%';

        $query->where(function (Builder $query) use ($searchKey) {
            $query->where('title', 'like', $searchKey)->orWhere('body', 'like', $searchKey);
        });
    }

    public function articleCountByType(array|string $types): Collection
    {
        return Article::whereIn('type', $types)
            ->selectRaw('type,count(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type');
    }

    public function articlesCount()
    {
        return Article::count();
    }
}
