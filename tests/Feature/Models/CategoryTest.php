<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_expected_columns_in_table()
    {
        $this->assertTrue(
            Schema::hasColumns('categories', [
                'id',
                'name',
                'created_at',
                'updated_at',
            ])
        );
    }

    /** @test */
    public function it_has_relationships()
    {
        $category = Category::factory()
            ->has(Todo::factory()->count(3), 'todos')
            ->create();

        $this->assertInstanceOf(Todo::class, $category->todos->first());
        $this->assertCount(3, $category->todos);
    }
}
