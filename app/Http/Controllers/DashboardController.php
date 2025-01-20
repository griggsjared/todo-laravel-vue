<?php

namespace App\Http\Controllers;

use App\Http\ViewData\CategoryViewData;
use App\Http\ViewData\TodoViewData;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(Request $request): InertiaResponse
    {
        /** @var string|null */
        $category = $request->input('category');

        /** @var InertiaResponse */
        return inertia('Dashboard', [
            'todos' => $this->todos($category),
            'categories' => $this->categories(),
            'category' => $request->has('category')
                ? $this->category($category)
                : null,
        ]);
    }

    private function category(?string $id): ?CategoryViewData
    {
        if (! $id) {
            return null;
        }

        $category = Category::where('id', $id)->first();

        return $category ? CategoryViewData::from($category) : null;
    }

    /**
     * @return Collection<int, TodoViewData>
     */
    private function todos(?string $categoryId): Collection
    {
        $categoryData = $categoryId ? $this->category($categoryId) : null;

        return Todo::query()
            ->when($categoryData, function (Builder $t) use ($categoryData): void {
                $t->whereHas('category', function (Builder $c) use ($categoryData): void {
                    $c->where('id', $categoryData->id ?? 0);
                });
            })
            ->with('category')
            ->get()
            ->map(fn (Todo $todo) => TodoViewData::from($todo));
    }

    /**
     * @return Collection<int, CategoryViewData>
     */
    private function categories(): Collection
    {
        return Category::all()->map(fn (Category $category) => CategoryViewData::from($category));
    }
}
