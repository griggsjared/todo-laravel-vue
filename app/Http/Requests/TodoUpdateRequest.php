<?php

namespace App\Http\Requests;

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
            'category' => ['nullable', 'uuid', 'exists:categories,uuid'],
        ];
    }
}
