<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        #[Uuid]
        public ?string $id,
        public string $name,
    ) {}
}
