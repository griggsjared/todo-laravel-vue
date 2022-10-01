<?php

namespace Tests\Feature\Actions;

use App\Actions\TodoDelete;
use App\Models\DTO\TodoData;
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

        $deleted = app(TodoDelete::class)->handle(
            TodoData::from($todo)
        );

        $todo = Todo::where('id', $todo->id)->first();

        $this->assertTrue($deleted);
        $this->assertNull($todo);
    }
}
