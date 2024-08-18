<?php

namespace App\Http\Requests;

use App\Data\TodoData;
use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class TodoDestroyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function todo(): Todo
    {
        /**
         * @var Todo $todo
         */
        $todo = $this->route('todo');

        return $todo;
    }

    public function todoData(): TodoData
    {
        return TodoData::from([
            ...$this->todo()->toArray(),
        ]);
    }
}
