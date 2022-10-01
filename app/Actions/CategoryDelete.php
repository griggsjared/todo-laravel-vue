<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\DTO\CategoryData;

class CategoryDelete
{
    public function handle(CategoryData $data): bool
    {
        $category = Category::find($data->id);

        if (! $category) {
            return false;
        }

        return $category->delete();
    }
}
