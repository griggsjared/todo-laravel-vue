<?php

namespace App\Http\Requests;

use App\Data\TodoData;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class TodoStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function category(): ?Category
    {
        /** @var Category|null */
        return Category::find($this->input('category'));
    }

    public function todoData(): TodoData
    {
        return TodoData::from([
            ...$this->validated(),
            'category' => $this->category(),
        ]);
    }
}
