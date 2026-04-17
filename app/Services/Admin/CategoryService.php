<?php

namespace App\Services\Admin;

use App\Models\Category;

class CategoryService
{
    public function create(array $data): Category
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update([
            'name' => $data['name'],
        ]);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}