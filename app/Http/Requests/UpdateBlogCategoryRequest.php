<?php

namespace App\Http\Requests;

use App\Models\BlogCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateBlogCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        /** @var BlogCategory|null $blogCategory */
        $blogCategory = $this->route('blog_category');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(BlogCategory::class, 'name')->ignore($blogCategory)],
            'slug' => ['required', 'string', 'max:255', Rule::unique(BlogCategory::class, 'slug')->ignore($blogCategory)],
            'description' => ['nullable', 'string', 'max:1000'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:320'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug((string) $this->input('slug', $this->input('name'))),
        ]);
    }
}
