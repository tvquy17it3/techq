<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function findById($id)
    {
        return Category::findOrFail($id);
    }
}