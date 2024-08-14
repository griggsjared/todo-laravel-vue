<?php

namespace App\View\DTO;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class TodoData extends Data
{
    public function __construct(
        #[Uuid]
        public string $id,
        public string $name,
        public bool $is_complete,
        public ?CategoryData $category
    ) {
    }
}
