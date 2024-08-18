<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoToggleComplete;
use App\Data\TodoData;
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

        app(TodoToggleComplete::class)->handle($data, true);

        $todo->refresh();

        $this->assertTrue($todo->is_complete);
    }

    /** @test */
    public function it_updated_to_incomplete()
    {
        $todo = Todo::factory()->complete()->create();

        $data = TodoData::from($todo);

        app(TodoToggleComplete::class)->handle($data, false);

        $todo->refresh();

        $this->assertFalse($todo->is_complete);
    }
}
