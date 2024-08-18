<?php

namespace App\Http\Controllers;

use App\Actions\TodoToggleComplete;
use App\Http\Requests\TodoToggleCompleteRequest;
use App\Data\TodoData;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;

class TodoToggleCompleteController extends Controller
{
    public function __construct(
        private TodoToggleComplete $toggleComplete
    ) {
    }

    public function __invoke(TodoToggleCompleteRequest $request, Todo $todo): RedirectResponse
    {
        $this->toggleComplete->handle(
            TodoData::from($todo),
            $request->is_complete
        );

        return redirect()->back()->withMessages([
            __('Todo complete status has been updated.'),
        ]);
    }
}
