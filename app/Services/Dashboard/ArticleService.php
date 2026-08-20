<?php

namespace App\Services\Dashboard;

use App\Models\Article;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\FileManager\FileManagerRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class ArticleService
{
    public ArticleRepositoryInterface $articleRepository;
    public FileUploaderService $fileUploader;
    public CategoryRepositoryInterface $categoryRepository;
    public FileManagerRepositoryInterface $fileManagerRepository;

    public function __construct(ArticleRepositoryInterface  $articleRepository, FileUploaderService $fileUploader,
                                CategoryRepositoryInterface $categoryRepository,
                                FileManagerRepositoryInterface $fileManagerRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->fileUploader = $fileUploader;
        $this->categoryRepository = $categoryRepository;
        $this->fileManagerRepository = $fileManagerRepository;
    }

    public function get(?string $sort, ?string $searchKey)
    {
        return $this->articleRepository->get($sort, $searchKey);
    }

    public function store(array $validatedData, UploadedFile $file = null): Article
    {
        if ($file) {
            $thumbnails = $this->fileUploader->upload($validatedData['thumbnails'], true);
            $validatedData['thumbnails'] = $thumbnails;
        }

        return $this->articleRepository->store($validatedData);
    }

    public function update(array $validatedData, Article $article, UploadedFile $file = null): bool
    {
        if ($file) {
            $thumbnails = $this->fileUploader->upload($file, true);
            $validatedData['thumbnails'] = $thumbnails;
        }

        return $this->articleRepository->update($validatedData, $article);
    }

    public function updateStatus(string $status, Article $article): bool
    {
        return $this->articleRepository->updateStatus($status, $article);
    }

    public function destroy(Article $article): bool
    {
        return $this->articleRepository->destroy($article);
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->all();
    }

    public function getAllFiles(): Collection
    {
        return $this->fileManagerRepository->all();
    }

    public function articleCountByType()
    {
        $types = ['text', 'multimedia'];
        return $this->articleRepository->articleCountByType($types);
    }

    public function articlesCount()
    {
        return $this->articleRepository->articlesCount();
    }
}
