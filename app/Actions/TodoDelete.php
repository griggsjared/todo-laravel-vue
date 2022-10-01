<?php

namespace App\Actions;

use App\Models\DTO\TodoData;
use App\Models\Todo;

class TodoDelete
{
    public function handle(TodoData $data): bool
    {
        $todo = Todo::find($data->id);

        if (! $todo) {
            return false;
        }

        return $todo->delete();
    }
}
