<?php

namespace Tests\Feature\Actions;

use App\Actions\CategoryDelete;
use App\Models\Category;
use App\Models\DTO\CategoryData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deleted_category()
    {
        $category = Category::factory()->create();

        $deleted = app(CategoryDelete::class)->handle(
            CategoryData::from($category)
        );

        $category = Category::whereUuid($category->uuid)->first();

        $this->assertTrue($deleted);
        $this->assertNull($category);
    }
}
