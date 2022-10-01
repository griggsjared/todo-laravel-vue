<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\View\DTO\CategoryData;
use App\View\DTO\TodoData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    public function __invoke(Request $request): InertiaResponse
    {
        return Inertia::render('Dashboard', [
            'todos' => $this->todos($request->query('category')),
            'categories' => $this->categories(),
            'category' => $request->has('category')
                ? $this->category($request->query('category'))
                : null,
        ]);
    }

    private function category(string $uuid): ?CategoryData
    {
        $category = Category::whereUuid($uuid)->first();

        return $category ? CategoryData::from($category) : null;
    }

    /**
     * @return Collection<TodoData>
     */
    private function todos(?string $categoryUuid): Collection
    {
        $categoryData = $categoryUuid ? $this->category($categoryUuid) : null;

        return Todo::query()
            ->when($categoryData, function (Builder $t) use ($categoryData): void {
                $t->whereHas('category', function (Builder $c) use ($categoryData): void {
                    $c->whereUuid($categoryData->uuid);
                });
            })
            ->with('category')
            ->get()
            ->map(fn (Todo $todo): TodoData => TodoData::from($todo));
    }

    /**
     * @return Collection<CategoryData>
     */
    private function categories(): Collection
    {
        return Category::query()
            ->get()
            ->map(fn (Category $category): CategoryData => CategoryData::from($category));
    }
}
