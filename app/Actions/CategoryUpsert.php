<?php

namespace App\Actions;

use App\Models\Category;
use App\Data\CategoryData;

class CategoryUpsert
{
    public function handle(CategoryData $data): CategoryData
    {
        $category = Category::updateOrCreate(
            ['id' => $data->id],
            ['name' => $data->name]
        );

        return CategoryData::from($category);
    }
}
