<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_rendered_dashboard(): void
    {
        Category::factory(2)
            ->has(Todo::factory()->count(4), 'todos')
            ->create();

        $this->get(route('dashboard'))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Dashboard')
                ->has('categories')
                ->has('todos')
            );
    }

    /** @test */
    public function it_rendered_dashboard_scoped_to_category(): void
    {
        Category::factory(2)
            ->has(Todo::factory()->count(4), 'todos')
            ->create();

        $this->get(route('dashboard', ['category' => Category::first()->id]))
            ->assertInertia(fn (Assert $page) => $page
                ->component('Dashboard')
                ->count('todos', 4)
            );
    }
}
