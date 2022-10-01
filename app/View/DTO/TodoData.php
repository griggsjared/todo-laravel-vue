<?php

namespace App\View\DTO;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TodoData extends Data
{
    public function __construct(
        #[Uuid()]
        public string $uuid,
        public string $name,
        public bool $is_complete,
        public ?CategoryData $category
    ) {
    }
}
