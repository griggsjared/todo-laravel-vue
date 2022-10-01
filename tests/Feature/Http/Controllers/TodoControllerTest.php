<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stored(): void
    {
        $category = Category::factory()->create();

        $this->post(route('todos.store'), [
            'name' => 'Todo one',
            'category' => $category->uuid,
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Todo has been created.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'name' => 'Todo one',
            'category_id' => $category->id,
        ]);
    }

    /** @test */
    public function it_stored_without_category(): void
    {
        $this->post(route('todos.store'), [
            'name' => 'Todo one',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Todo has been created.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'name' => 'Todo one',
            'category_id' => null,
        ]);
    }

    /** @test */
    public function it_updated(): void
    {
        $todo = Todo::factory()
            ->for(Category::factory(), 'category')
            ->create();

        $this->put(route('todos.update', $todo), [
            'name' => 'Todo one',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Todo has been updated.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'name' => 'Todo one',
        ]);
    }

    /** @test */
    public function it_updated_without_category(): void
    {
        $todo = Todo::factory()
            ->for(Category::factory(), 'category')
            ->create();

        $this->put(route('todos.update', $todo), [
            'name' => 'Todo one',
            'category' => null,
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Todo has been updated.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'name' => 'Todo one',
            'category_id' => null,
        ]);
    }

    /** @test */
    public function it_destroyed(): void
    {
        $todo = Todo::factory()
            ->for(Category::factory(), 'category')
            ->create();

        $this->delete(route('todos.destroy', $todo))
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Todo has been deleted.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }
}
