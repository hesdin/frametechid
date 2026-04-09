<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of published blog posts.
     */
    public function index(): Response
    {
        $posts = Post::query()
            ->published()
            ->latest('published_at')
            ->get();

        return Inertia::render('Blog', [
            'posts' => $posts->map(fn (Post $post): array => [
                'id' => $post->id,
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'coverImage' => $post->cover_image,
                'publishedAt' => $post->published_at?->format('F j, Y'),
            ])->all(),
        ]);
    }

    /**
     * Display the specified blog post.
     */
    public function show(Post $post): Response
    {
        abort_unless($post->isPublished(), 404);

        $post->loadMissing('author:id,name');

        $latestPosts = Post::query()
            ->published()
            ->whereKeyNot($post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return Inertia::render('BlogShow', [
            'post' => [
                'id' => $post->id,
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'coverImage' => $post->cover_image,
                'publishedAt' => $post->published_at?->format('F j, Y'),
                'author' => $post->author?->name ?? 'Tim '.SiteSetting::current()->site_name,
            ],
            'latestPosts' => $latestPosts->map(fn (Post $relatedPost): array => [
                'id' => $relatedPost->id,
                'slug' => $relatedPost->slug,
                'title' => $relatedPost->title,
                'publishedAt' => $relatedPost->published_at?->format('F j, Y'),
            ])->all(),
        ]);
    }
}
