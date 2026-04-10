<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogTagRequest;
use App\Http\Requests\UpdateBlogTagRequest;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BlogTagController extends Controller
{
    public function index(): Response
    {
        $tags = BlogTag::query()->withCount('posts')->orderBy('name')->get();

        return Inertia::render('cms/blog-tags/Index', [
            'stats' => [
                'totalTags' => $tags->count(),
                'usedTags' => $tags->where('posts_count', '>', 0)->count(),
            ],
            'tags' => $tags->map(fn (BlogTag $tag): array => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
                'postsCount' => $tag->posts_count,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/blog-tags/Create', [
            'tag' => $this->formData(new BlogTag),
        ]);
    }

    public function store(StoreBlogTagRequest $request): RedirectResponse
    {
        BlogTag::query()->create($request->validated());

        return to_route('cms.blog-tags.index')
            ->with('success', 'Tag blog berhasil ditambahkan.');
    }

    public function edit(BlogTag $blogTag): Response
    {
        return Inertia::render('cms/blog-tags/Edit', [
            'tag' => $this->formData($blogTag),
        ]);
    }

    public function update(UpdateBlogTagRequest $request, BlogTag $blogTag): RedirectResponse
    {
        $blogTag->fill($request->validated())->save();

        return to_route('cms.blog-tags.index')
            ->with('success', 'Tag blog berhasil diperbarui.');
    }

    public function destroy(BlogTag $blogTag): RedirectResponse
    {
        $blogTag->delete();

        return to_route('cms.blog-tags.index')
            ->with('success', 'Tag blog berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function formData(BlogTag $blogTag): array
    {
        return [
            'id' => $blogTag->id,
            'name' => $blogTag->name ?? '',
            'slug' => $blogTag->slug ?? '',
        ];
    }
}
