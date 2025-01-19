<?php

namespace App\Http\Controllers;

use App\Actions\TodoDelete;
use App\Actions\TodoUpsert;
use App\Http\Requests\TodoDestroyRequest;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;

class TodoController extends Controller
{
    public function __construct(
        private TodoUpsert $upsert,
        private TodoDelete $delete,
    ) {}

    public function store(TodoStoreRequest $request): RedirectResponse
    {
        $this->upsert->handle(
            $request->todoData()
        );

        return redirect()->back()->withMessages([
            __('Todo has been created.'),
        ]);
    }

    public function update(Todo $todo, TodoUpdateRequest $request): RedirectResponse
    {
        $this->upsert->handle(
            $request->todoData()
        );

        return redirect()->back()->withMessages([
            __('Todo has been updated.'),
        ]);
    }

    public function destroy(Todo $todo, TodoDestroyRequest $request): RedirectResponse
    {
        $this->delete->handle(
            $request->todoData()
        );

        return redirect()->back()->withMessages([
            __('Todo has been deleted.'),
        ]);
    }
}
