<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\DTO\TodoData;
use App\Actions\TodoToggleComplete;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TodoToggleCompleteRequest;

class TodoToggleCompleteController extends Controller
{
    public function __invoke(TodoToggleCompleteRequest $request, Todo $todo, TodoToggleComplete $action): RedirectResponse
    {
        $action->handle(
            TodoData::from($todo),
            $request->is_complete
        );

        return redirect()->back()->withMessages([
            __('Todo complete status has been updated.'),
        ]);
    }
}
