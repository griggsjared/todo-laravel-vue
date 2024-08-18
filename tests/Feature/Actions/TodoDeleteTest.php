<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoDelete;
use App\Data\TodoData;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deleted_todo()
    {
        $todo = Todo::factory()->create();

        app(TodoDelete::class)->handle(
            TodoData::from($todo)
        );

        $todo = Todo::where('id', $todo->id)->first();

        $this->assertNull($todo);
    }
}
