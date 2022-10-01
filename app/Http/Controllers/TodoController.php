<?php

namespace App\Http\Controllers;

use App\Actions\TodoDelete;
use App\Actions\TodoUpsert;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Models\Category;
use App\Models\DTO\TodoData;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;

class TodoController extends Controller
{
    public function store(TodoStoreRequest $request, TodoUpsert $action): RedirectResponse
    {
        $created = $action->handle(TodoData::from([
            ...$request->validated(),
            'category' => Category::whereUuid($request->category)->first(),
        ]));

        return redirect()->back()->withMessages([
            __('Todo has been created.'),
        ]);
    }

    public function update(Todo $todo, TodoUpdateRequest $request, TodoUpsert $action): RedirectResponse
    {
        $updated = $action->handle(
            TodoData::from([
                ...$todo->toArray(),
                ...$request->validated(),
                'category' => Category::whereUuid($request->category)->first(),
            ])
        );

        return redirect()->back()->withMessages([
            __('Todo has been updated.'),
        ]);
    }

    public function destroy(Todo $todo, TodoDelete $action): RedirectResponse
    {
        $deleted = $action->handle(
            TodoData::from($todo)
        );

        return redirect()->back()->withMessages([
            __('Todo has been deleted.'),
        ]);
    }
}
