<?php

namespace App\Models\DTO;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        #[Uuid]
        public ?string $id,
        public string $name,
    ) {
    }
}
