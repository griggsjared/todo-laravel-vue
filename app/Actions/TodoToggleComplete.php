<?php

namespace App\Actions;

use App\Models\Todo;
use App\Actions\TodoUpsert;
use App\Models\DTO\TodoData;

class TodoToggleComplete
{

    public function __construct(
        private TodoUpsert $upsert
    ){
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
