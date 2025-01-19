<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TodoData extends Data
{
    public function __construct(
        #[Uuid]
        public ?string $id,
        public string $name,
        public ?bool $is_complete,
        public Optional|CategoryData|null $category
    ) {
    }
}
