<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoUpsert;
use App\Data\CategoryData;
use App\Data\TodoData;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoUpsertTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_created_todo()
    {
        $data = TodoData::from([
            'name' => 'Walk the dog',
        ]);

        $data = app(TodoUpsert::class)->handle($data);

        $todo = Todo::find($data->id);

        $this->assertEquals($data->name, $todo->name);
    }

    /** @test */
    public function it_updated_tdo()
    {
        $todo = Todo::factory()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'name' => 'Walk the dog again',
        ]);

        app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertEquals($data->name, $todo->name);
    }

    /** @test */
    public function it_updated_todo_to_complete()
    {
        $todo = Todo::factory()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'is_complete' => true,
        ]);

        app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertTrue($todo->is_complete);
    }

    /** @test */
    public function it_updated_todo_to_incomplete()
    {
        $todo = Todo::factory()->complete()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'is_complete' => false,
        ]);

        $data = app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertFalse($todo->is_complete);
    }

    /** @test */
    public function it_assigned_todo_to_category()
    {
        $todo = Todo::factory()->create();

        $catoegory = Category::factory()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'category' => CategoryData::from($catoegory),
        ]);

        app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertEquals($catoegory->id, $todo->category->id);
    }

    /** @test */
    public function it_unassigned_todo_from_category()
    {
        $todo = Todo::factory()
            ->for(Category::factory()->create(), 'category')
            ->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'category' => null,
        ]);

        app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertNull($todo->category);
    }

    /** @test */
    public function it_creates_a_category_if_it_does_not_exist()
    {
        $todo = Todo::factory()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'category' => CategoryData::from([
                'name' => 'New Category',
            ]),
        ]);

        app(TodoUpsert::class)->handle($data);

        $todo->refresh();

        $this->assertEquals('New Category', $todo->category->name);
    }
}
