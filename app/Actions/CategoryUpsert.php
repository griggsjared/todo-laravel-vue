<?php

namespace App\Actions;

use App\Data\CategoryData;
use App\Models\Category;

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
