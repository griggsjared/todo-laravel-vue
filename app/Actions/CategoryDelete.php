<?php

namespace App\Actions;

use App\Data\CategoryData;
use App\Models\Category;

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
