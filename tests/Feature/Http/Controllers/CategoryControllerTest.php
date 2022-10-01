<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stored(): void
    {
        $this->post(route('categories.store'), [
            'name' => 'Category name',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Category has been created.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('categories', [
            'name' => 'Category name',
        ]);
    }

    /** @test */
    public function it_updated(): void
    {
        $category = Category::factory()->create();

        $this->put(route('categories.update', $category), [
            'name' => 'Category name',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Category has been updated.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Category name',
        ]);
    }

    /** @test */
    public function it_destroyed(): void
    {
        $category = Category::factory()->create();

        $this->delete(route('categories.destroy', $category))
            ->assertRedirect('/')
            ->assertSessionHas('messages', [
                __('Category has been deleted.'),
            ])
            ->assertSessionDoesntHaveErrors('errors');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
