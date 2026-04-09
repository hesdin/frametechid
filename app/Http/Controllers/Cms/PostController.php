<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
            ->with('author:id,name')
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
            ])->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('cms/blog/Create', [
            'post' => [
                'title' => '',
                'slug' => '',
                'excerpt' => '',
                'content' => '',
                'coverImage' => '',
                'status' => 'draft',
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = Post::query()->create([
            ...$this->preparePayload($request->validated()),
            'author_id' => $request->user()->id,
        ]);

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
        return Inertia::render('cms/blog/Edit', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'coverImage' => $post->cover_image ?? '',
                'status' => $post->status,
                'publishedAt' => $post->published_at?->format('F j, Y H:i'),
                'updatedAt' => $post->updated_at->diffForHumans(),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($this->preparePayload($request->validated(), $post));

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
}
