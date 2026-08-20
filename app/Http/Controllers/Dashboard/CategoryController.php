<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::withCount('articles')->orderBy('id', 'asc')->paginate(5);
        $categoryCount = Category::count();
        return view('dashboard.categories.create', compact('categories', 'categoryCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $createdCategory = Category::create($request->validated());
        return createToast('back', 'دسته‌بندی', $createdCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $updatedCategory = $category->update($request->validated());
        return editToast('category.create', 'دسته‌بندی ' . $category->name, $updatedCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $deletedCategory = $category->delete();
        return deleteToast('category.create', 'دسته‌بندی ' . $category->name, $deletedCategory);
    }
}
