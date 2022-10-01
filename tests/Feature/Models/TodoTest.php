<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_expected_columns_in_table()
    {
        $this->assertTrue(
            Schema::hasColumns('todos', [
                'id',
                'uuid',
                'name',
                'category_id',
                'is_complete',
                'created_at',
                'updated_at',
            ])
        );
    }

    /** @test */
    public function it_has_valid_uuid()
    {
        $todo = Todo::factory()->create();

        $this->assertTrue(
            Uuid::isValid($todo->uuid)
        );
    }

    /** @test */
    public function it_has_relationships()
    {
        $todo = Todo::factory()
            ->for(Category::factory()->create(), 'category')
            ->create();

        $this->assertInstanceOf(Category::class, $todo->category);
    }
}
