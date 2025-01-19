<?php

namespace App\Http\Controllers;

use App\Actions\TodoUpsert;
use App\Http\Requests\TodoToggleCompleteRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;

class TodoToggleCompleteController extends Controller
{
    public function __construct(
        private TodoUpsert $todoUpsert
    ) {}

    public function __invoke(Todo $todo, TodoToggleCompleteRequest $request): RedirectResponse
    {
        $this->todoUpsert->handle(
            $request->todoData(),
        );

        return redirect()->back()->withMessages([
            __('Todo complete status has been updated.'),
        ]);
    }
}
