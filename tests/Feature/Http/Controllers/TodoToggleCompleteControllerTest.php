<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoToggleCompleteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updated_to_complete(): void
    {
        $todo = Todo::factory()->incomplete()->create();

        $this->put(route('todos.toggle-complete', $todo), [
            'is_complete' => true,
        ])
            ->assertRedirect('/')
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_complete' => 1
        ]);
    }

    /** @test */
    public function it_updated_to_incomplete(): void
    {
        $todo = Todo::factory()->complete()->create();

        $this->put(route('todos.toggle-complete', $todo), [
            'is_complete' => false,
        ])
            ->assertRedirect('/')
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'is_complete' => 0
        ]);
    }

}
