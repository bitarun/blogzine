<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Services\Dashboard\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller implements HasMiddleware
{
    public ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public static function middleware()
    {
        return [
            new Middleware('role:author|admin', ['index', 'create']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->validateSort($request->all());
        $sort = $data->validated()['sort'] ?? null;
        $searchKey = $data->validated()['search'] ?? null;

        $articles = $this->articleService->get($sort, $searchKey);
        $countByType = $this->articleService->articleCountByType();
        $count = $this->articleService->articlesCount();

        if ($articles->currentPage() > $articles->lastPage()) {
            abort(404);
        }

        return view('dashboard.articles.index', [
            'articles' => $articles->appends(['sort' => $sort, 'search' => $searchKey]),
            'countByType' => $countByType,
            'count' => $count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->articleService->getAllCategories();
        $files = $this->articleService->getAllFiles();
        return view('dashboard.articles.create', compact('categories', 'files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $file = $request->file('thumbnails');
            $this->articleService->store($validatedData, $file);
            return toastRedirect('article.index', 'مقاله ی شما با موفقیت ایجاد شد.');

        } catch (\Exception $e) {
            return toastRedirect('back', 'عملیات ایجاد مقاله‌ی جدید با مشکل مواچه گردید.', 'danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article, Request $request)
    {
        $categories = $this->articleService->getAllCategories();
        $files = $this->articleService->getAllFiles();
        return view('dashboard.articles.edit', compact('article', 'categories', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleStoreRequest $request, Article $article)
    {
        try {
            $validatedData = $request->validated();
            $file = $request->file('thumbnails');
            $this->articleService->update($validatedData, $article, $file);
            return toastRedirect('article.index', 'مقاله ی شما با موفقیت ویرایش شد.');

        } catch (\Exception $e) {
            return toastRedirect('back', 'بروزرسانی مقاله ' . $article->title . 'با مشکل مواجه گردید.', 'danger');
        }
    }

    public function updateStatus(Article $article, Request $request)
    {
        try {
            $request->validate([
                'status' => ['required', 'in:pending,published'],
            ]);

            $this->articleService->updateStatus($request->status, $article);

            $status = $request->status === 'published' ? 'منتشر شده' : 'بازبینی';

            return response()->json([
                'type' => 'success',
                'message' => 'تغییر وضعیت مقاله شماره ' . $article->id . ' به ' . $status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => 'خطا در تغییر وضعیت مقاله شماره ' . $article->id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            $this->articleService->destroy($article);
            return response()->json([
                'type' => 'success',
                'message' => 'مقاله شماره ' . $article->id . ' با موفقیت حذف شد.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => 'حذف مقاله شماره ' . $article->id . ' با خطا مواجه گردید.',
            ]);
        }
    }

    public function validateSort($request)
    {
        $validator = Validator::make($request, [
            'sort' => ['in:newest,oldest,popular'],
            'search' => ['max:255'],
        ], [
            'sort.in' => 'لطفا دسته‌بندی را از بین گزینه‌های تعیین شده انتخاب کنید!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return $validator;
    }
}
