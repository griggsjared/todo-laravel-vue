<?php

namespace App\Http\Requests;

use App\Data\CategoryData;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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

    public function category(): Category
    {
        /**
         * @var Category $category
         */
        $category = $this->route('category');

        return $category;
    }

    public function categoryData(): CategoryData
    {
        return CategoryData::from([
            ...$this->category()->toArray(),
            ...$this->validated(),
        ]);
    }
}
