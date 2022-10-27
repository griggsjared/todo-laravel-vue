<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\DTO\CategoryData;

class CategoryDelete
{
    public function handle(CategoryData $data): ?CategoryData
    {
        $category = Category::find($data->id);

        if (! $category) {
            return null;
        }

        $category->delete();

        return CategoryData::from($category);
    }
}
