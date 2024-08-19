<?php

namespace App\Http\Requests;

use App\Data\TodoData;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_complete' => ['nullable', 'boolean'],
            'category' => ['nullable', 'id', 'exists:categories,id']
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

    public function category(): ?Category
    {
        return Category::find($this->input('category'));
    }

    public function todoData(): TodoData
    {
        return TodoData::from([
            ...$this->todo()->toArray(),
            ...$this->validated(),
            'category' => $this->category(),
        ]);
    }
}
