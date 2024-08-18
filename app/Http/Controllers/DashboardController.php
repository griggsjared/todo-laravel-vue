<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Http\ViewData\CategoryData;
use App\Http\ViewData\TodoData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Response as InertiaResponse;
use Log;

class DashboardController extends Controller
{
    public function __invoke(Request $request): InertiaResponse
    {
        return inertia('Dashboard', [
            'todos' => $this->todos($request->query('category')),
            'categories' => $this->categories(),
            'category' => $request->has('category')
                ? $this->category($request->query('category'))
                : null,
        ]);
    }

    private function category(string $id): ?CategoryData
    {
        $category = Category::where('id', $id)->first();

        return $category ? CategoryData::from($category) : null;
    }

    /**
     * @return Collection<TodoData>
     */
    private function todos(?string $categoryId): Collection
    {
        $categoryData = $categoryId ? $this->category($categoryId) : null;

        return Todo::query()
            ->when($categoryData, function (Builder $t) use ($categoryData): void {
                $t->whereHas('category', function (Builder $c) use ($categoryData): void {
                    $c->where('id', $categoryData->id);
                });
            })
            ->with('category')
            ->get()
            ->map(fn (Todo $todo) => TodoData::from($todo));
    }

    /**
     * @return Collection<CategoryData>
     */
    private function categories(): Collection
    {
        return Category::all()->map(fn (Category $category) => CategoryData::from($category));
    }
}
