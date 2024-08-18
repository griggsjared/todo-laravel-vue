<?php

namespace App\Http\Requests;

use App\Data\CategoryData;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function categoryData(): CategoryData
    {
        return CategoryData::from($this->validated());
    }
}
