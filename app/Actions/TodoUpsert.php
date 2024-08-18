<?php

namespace App\Actions;

use App\Data\CategoryData;
use App\Data\TodoData;
use App\Models\Todo;

class TodoUpsert
{
    public function __construct(
        private CategoryUpsert $categoryUpsert
    ) {
    }

    public function handle(TodoData $data): TodoData
    {
        $todo = Todo::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
            ]
        );

        $todo->is_complete = $data->is_complete ? 1 : 0;

        if ($data->category instanceof CategoryData) {
            $categoryData = $this->categoryUpsert->handle($data->category);
            $todo->category()->associate($categoryData->id);
        } elseif ($data->category == null) {
            $todo->category()->dissociate();
        }

        $todo->save();

        return TodoData::from($todo);
    }
}
