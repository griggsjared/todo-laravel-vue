<?php

namespace App\Http\Requests;

use App\Data\TodoData;
use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class TodoToggleCompleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'is_complete' => ['required', 'boolean'],
        ];
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
            'is_complete' => $this->boolean('is_complete'),
        ]);
    }
}
