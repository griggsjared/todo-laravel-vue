<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\DTO\CategoryData;

class CategoryUpsert
{
    public function handle(CategoryData $data): Category
    {
        $category = Category::updateOrCreate(
            ['id' => $data->id],
            ['name' => $data->name]
        );

        return $category;
    }
}
