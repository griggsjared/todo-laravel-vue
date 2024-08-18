<?php

namespace App\Actions;

use App\Data\TodoData;

class TodoToggleComplete
{
    public function __construct(
        private TodoUpsert $upsert
    ) {
    }

    public function handle(TodoData $data, bool $complete): TodoData
    {
        return $this->upsert->handle(
            TodoData::from([
                ...$data->toArray(),
                'is_complete' => $complete,
            ])
        );
    }
}
