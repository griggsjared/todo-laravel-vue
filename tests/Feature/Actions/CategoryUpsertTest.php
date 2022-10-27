<?php

namespace Tests\Feature\Actions;

use App\Actions\CategoryUpsert;
use App\Models\Category;
use App\Models\DTO\CategoryData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryUpsertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_created_category()
    {
        $data = CategoryData::from([
            'name' => 'Test Category',
        ]);

        $data = app(CategoryUpsert::class)->handle($data);

        $category = Category::find($data->id);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($data->name, $category->name);
    }

    /** @test */
    public function it_updated_category()
    {
        $category = Category::factory()->create();

        $data = CategoryData::from([
            ...$category->toArray(),
            'name' => 'Updated Category',
        ]);

        $data = app(CategoryUpsert::class)->handle($data);

        $category->refresh();

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($data->name, $category->name);
        $this->assertEquals($category->id, $category->id);
    }
}
