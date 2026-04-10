<?php

namespace App\Concerns;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait PostValidationRules
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function postRules(?Post $post = null): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Post::class, 'slug')->ignore($post),
            ],
            'excerpt' => ['required', 'string', 'max:320'],
            'content' => ['required', 'string', 'min:50'],
            'cover_image' => ['nullable', 'url', 'max:2048'],
            'category_id' => ['nullable', 'integer', Rule::exists(BlogCategory::class, 'id')],
            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', Rule::exists(BlogTag::class, 'id')],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:320'],
            'seo_keywords' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function postMessages(): array
    {
        return [
            'title.required' => 'Judul artikel wajib diisi.',
            'slug.required' => 'Slug artikel wajib diisi.',
            'slug.unique' => 'Slug ini sudah dipakai artikel lain.',
            'excerpt.required' => 'Ringkasan artikel wajib diisi.',
            'excerpt.max' => 'Ringkasan maksimal 320 karakter.',
            'content.required' => 'Isi artikel wajib diisi.',
            'content.min' => 'Isi artikel minimal 50 karakter.',
            'cover_image.url' => 'Cover image harus berupa URL yang valid.',
            'category_id.exists' => 'Kategori blog yang dipilih tidak valid.',
            'status.required' => 'Status artikel wajib dipilih.',
            'status.in' => 'Status artikel tidak valid.',
            'seo_description.max' => 'Meta description maksimal 320 karakter.',
        ];
    }
}
