<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoUpsert;
use App\Models\Category;
use App\Models\DTO\CategoryData;
use App\Models\DTO\TodoData;
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

        $todo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $todo);
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

        $updatedTodo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertEquals($data->name, $updatedTodo->name);
        $this->assertEquals($todo->id, $updatedTodo->id);
    }

    /** @test */
    public function it_updated_todo_to_complete()
    {
        $todo = Todo::factory()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'is_complete' => true,
        ]);

        $updatedTodo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertTrue($updatedTodo->is_complete);
        $this->assertEquals($todo->id, $updatedTodo->id);
    }

    /** @test */
    public function it_updated_todo_to_incomplete()
    {
        $todo = Todo::factory()->complete()->create();

        $data = TodoData::from([
            ...$todo->toArray(),
            'is_complete' => false,
        ]);

        $updatedTodo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertFalse($updatedTodo->is_complete);
        $this->assertEquals($todo->id, $updatedTodo->id);
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

        $updatedTodo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertEquals($todo->id, $updatedTodo->id);
        $this->assertEquals($catoegory->id, $updatedTodo->category->id);
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

        $updatedTodo = app(TodoUpsert::class)->handle($data);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertEquals($todo->id, $updatedTodo->id);
        $this->assertNull($updatedTodo->category);
    }
}
