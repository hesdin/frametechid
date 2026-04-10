<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $posts = Post::query()
            ->latest('updated_at')
            ->with(['author:id,name', 'category:id,name', 'tags:id,name'])
            ->get();

        return Inertia::render('cms/blog/Index', [
            'stats' => [
                'totalPosts' => $posts->count(),
                'publishedPosts' => $posts->where('status', 'published')->count(),
                'draftPosts' => $posts->where('status', 'draft')->count(),
            ],
            'posts' => $posts->map(fn (Post $post): array => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'status' => $post->status,
                'coverImage' => $post->cover_image,
                'publishedAt' => $post->published_at?->format('F j, Y'),
                'updatedAt' => $post->updated_at->diffForHumans(),
                'author' => $post->author?->name ?? 'Tim '.SiteSetting::current()->site_name,
                'category' => $post->category?->name,
                'tags' => $post->tags->pluck('name')->all(),
                'hasSeo' => filled($post->seo_title) || filled($post->seo_description),
            ])->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('cms/blog/Create', [
            'post' => $this->postFormData(new Post([
                'status' => 'draft',
            ])),
            'categories' => $this->categories(),
            'tags' => $this->tags(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = Post::query()->create([
            ...$this->preparePayload($request->safe()->except('tag_ids')),
            'author_id' => $request->user()->id,
        ]);
        $post->tags()->sync($request->safe()->collect()->get('tag_ids', []));

        return to_route('cms.blog.edit', $post)
            ->with('success', 'Artikel blog berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): RedirectResponse
    {
        return to_route('cms.blog.edit', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        $post->loadMissing('tags:id,name');

        return Inertia::render('cms/blog/Edit', [
            'post' => $this->postFormData($post),
            'categories' => $this->categories(),
            'tags' => $this->tags(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($this->preparePayload($request->safe()->except('tag_ids'), $post));
        $post->tags()->sync($request->safe()->collect()->get('tag_ids', []));

        return to_route('cms.blog.edit', $post)
            ->with('success', 'Artikel blog berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return to_route('cms.blog.index')
            ->with('success', 'Artikel blog berhasil dihapus.');
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    protected function preparePayload(array $validated, ?Post $post = null): array
    {
        $shouldPublish = $validated['status'] === 'published';

        return [
            ...$validated,
            'published_at' => $shouldPublish
                ? ($post?->published_at ?? now())
                : null,
        ];
    }

    /**
     * @return array<int, array{id:int,label:string}>
     */
    protected function categories(): array
    {
        return BlogCategory::query()
            ->orderBy('name')
            ->get()
            ->map(fn (BlogCategory $category): array => [
                'id' => $category->id,
                'label' => $category->name,
            ])->all();
    }

    /**
     * @return array<int, array{id:int,label:string}>
     */
    protected function tags(): array
    {
        return BlogTag::query()
            ->orderBy('name')
            ->get()
            ->map(fn (BlogTag $tag): array => [
                'id' => $tag->id,
                'label' => $tag->name,
            ])->all();
    }

    /**
     * @return array<string, mixed>
     */
    protected function postFormData(Post $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title ?? '',
            'slug' => $post->slug ?? '',
            'excerpt' => $post->excerpt ?? '',
            'content' => $post->content ?? '',
            'coverImage' => $post->cover_image ?? '',
            'status' => $post->status ?? 'draft',
            'categoryId' => $post->category_id,
            'tagIds' => $post->relationLoaded('tags') ? $post->tags->pluck('id')->all() : [],
            'seoTitle' => $post->seo_title ?? '',
            'seoDescription' => $post->seo_description ?? '',
            'seoKeywords' => $post->seo_keywords ?? '',
            'publishedAt' => $post->published_at?->format('F j, Y H:i'),
            'updatedAt' => $post->exists ? $post->updated_at?->diffForHumans() : null,
        ];
    }
}
