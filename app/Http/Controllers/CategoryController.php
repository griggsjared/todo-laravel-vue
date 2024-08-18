<?php

namespace App\Http\Controllers;

use App\Actions\CategoryDelete;
use App\Actions\CategoryUpsert;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Data\CategoryData;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryUpsert $upsert,
        private CategoryDelete $delete,
    ) {
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $this->upsert->handle(CategoryData::from($request->validated()));

        return redirect()->back()->withMessages([
            __('Category has been created.'),
        ]);
    }

    public function update(Category $category, CategoryUpdateRequest $request): RedirectResponse
    {
        $this->upsert->handle(
            CategoryData::from([
                ...$category->toArray(),
                ...$request->validated(),
            ])
        );

        return redirect()->back()->withMessages([
            __('Category has been updated.'),
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->delete->handle(
            CategoryData::from($category)
        );

        return redirect()->back()->withMessages([
            __('Category has been deleted.'),
        ]);
    }
}
