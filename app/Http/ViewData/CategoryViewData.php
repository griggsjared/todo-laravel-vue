<?php

namespace App\Http\ViewData;

use Spatie\LaravelData\Attributes\Validation\Uuid;
use Spatie\LaravelData\Data;

class CategoryViewData extends Data
{
    public function __construct(
        #[Uuid]
        public string $id,
        public string $name
    ) {
    }
}
