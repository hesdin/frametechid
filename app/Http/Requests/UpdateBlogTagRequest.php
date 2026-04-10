<?php

namespace App\Http\Requests;

use App\Models\BlogTag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateBlogTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        /** @var BlogTag|null $blogTag */
        $blogTag = $this->route('blog_tag');

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(BlogTag::class, 'name')->ignore($blogTag)],
            'slug' => ['required', 'string', 'max:255', Rule::unique(BlogTag::class, 'slug')->ignore($blogTag)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug((string) $this->input('slug', $this->input('name'))),
        ]);
    }
}
