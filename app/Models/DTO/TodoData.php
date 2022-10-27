<?php

namespace App\Models\DTO;

use App\Models\Todo;
use Spatie\LaravelData\Data;

class TodoData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?bool $is_complete,
        public ?CategoryData $category
    ) {
    }

    public static function fromModel(Todo $todo): self
    {
        return self::from([
            ...$todo->toArray(),
            'category' => $todo->category ? CategoryData::from($todo->category) : null,
        ]);
    }
}
