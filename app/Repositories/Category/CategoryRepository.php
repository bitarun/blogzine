<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all(): Collection
    {
        return Category::all();
    }
}
