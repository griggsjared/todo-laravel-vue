<?php

namespace App\Actions;

use App\Models\DTO\TodoData;
use App\Models\Todo;

class TodoDelete
{
    public function handle(TodoData $data): ?TodoData
    {
        $todo = Todo::find($data->id);

        if (! $todo) {
            return null;
        }

        $todo->delete();

        return TodoData::from($todo);
    }
}
