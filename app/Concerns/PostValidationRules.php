<?php

namespace App\Concerns;

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
            'status' => ['required', Rule::in(['draft', 'published'])],
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
            'status.required' => 'Status artikel wajib dipilih.',
            'status.in' => 'Status artikel tidak valid.',
        ];
    }
}
