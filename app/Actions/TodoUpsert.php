<?php

namespace App\Actions;

use App\Models\DTO\TodoData;
use App\Models\Todo;

class TodoUpsert
{
    public function handle(TodoData $data): Todo
    {
        $todo = Todo::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ]
        );

        $todo->is_complete = $data->is_complete ? 1 : 0;

        if ($data->category?->id) {
            $todo->category()->associate($data->category->id);
        } else {
            $todo->category()->dissociate();
        }

        $todo->save();

        return $todo;
    }
}
