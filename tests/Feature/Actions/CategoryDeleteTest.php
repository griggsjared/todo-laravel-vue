<?php

namespace Tests\Feature\Actions;

use App\Actions\CategoryDelete;
use App\Data\CategoryData;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deleted_the_category()
    {
        $category = Category::factory()->create();

        app(CategoryDelete::class)->handle(
            CategoryData::from($category)
        );

        $category = Category::find($category->id);

        $this->assertNull($category);
    }
}
