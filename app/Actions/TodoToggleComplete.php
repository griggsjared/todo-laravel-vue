<?php

namespace App\Actions;

use App\Models\DTO\TodoData;
use App\Models\Todo;

class TodoToggleComplete
{
    public function __construct(
        private TodoUpsert $upsert
    ) {
    }

    public function handle(TodoData $data, bool $complete): Todo
    {
        $todo = $this->upsert->handle(
            TodoData::from([
                ...$data->toArray(),
                'is_complete' => $complete,
            ])
        );

        return $todo;
    }
}
