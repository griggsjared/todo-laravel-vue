<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoToggleComplete;
use App\Actions\TodoUpsert;
use App\Models\Category;
use App\Models\DTO\CategoryData;
use App\Models\DTO\TodoData;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoToggleCompleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updated_to_complete()
    {
        $todo = Todo::factory()->incomplete()->create();

        $data = TodoData::from($todo);

        $updatedTodo = app(TodoToggleComplete::class)->handle($data, true);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertTrue($updatedTodo->is_complete);
        $this->assertEquals($todo->id, $updatedTodo->id);
    }

    /** @test */
    public function it_updated_to_incomplete()
    {
        $todo = Todo::factory()->complete()->create();

        $data = TodoData::from($todo);

        $updatedTodo = app(TodoToggleComplete::class)->handle($data, false);

        $this->assertInstanceOf(Todo::class, $updatedTodo);
        $this->assertFalse($updatedTodo->is_complete);
        $this->assertEquals($todo->id, $updatedTodo->id);
    }
}
