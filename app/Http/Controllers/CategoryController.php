<?php

namespace App\Http\Controllers;

use App\Actions\CategoryDelete;
use App\Actions\CategoryUpsert;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\DTO\CategoryData;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function store(CategoryStoreRequest $request, CategoryUpsert $action): RedirectResponse
    {
        $created = $action->handle(CategoryData::from($request->validated()));

        return redirect()->back()->withMessages([
            __('Category has been created.'),
        ]);
    }

    public function update(Category $category, CategoryUpdateRequest $request, CategoryUpsert $action): RedirectResponse
    {
        $updated = $action->handle(
            CategoryData::from([
                ...$category->toArray(),
                ...$request->validated(),
            ])
        );

        return redirect()->back()->withMessages([
            __('Category has been updated.'),
        ]);
    }

    public function destroy(Category $category, CategoryDelete $action): RedirectResponse
    {
        $deleted = $action->handle(
            CategoryData::from($category)
        );

        return redirect()->back()->withMessages([
            __('Category has been deleted.'),
        ]);
    }
}
