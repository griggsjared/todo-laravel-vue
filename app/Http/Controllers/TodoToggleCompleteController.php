<?php

namespace App\Http\Controllers;

use App\Actions\TodoToggleComplete;
use App\Http\Requests\TodoToggleCompleteRequest;
use App\Models\DTO\TodoData;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;

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
