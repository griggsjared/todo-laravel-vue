<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoToggleCompleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_complete' => ['required', 'boolean'],
        ];
    }
}
