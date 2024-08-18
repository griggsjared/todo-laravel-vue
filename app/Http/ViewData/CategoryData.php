<?php

namespace App\Http\ViewData;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CategoryData extends Data
{
    public function __construct(
        #[Uuid]
        public string $id,
        public string $name,
        #[DataCollectionOf(TodoData::class)]
        public DataCollection|Optional $todos
    ) {
    }
}
