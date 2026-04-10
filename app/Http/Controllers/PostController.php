<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(Request $request): Response
    {
        $siteSetting = SiteSetting::current();
        $posts = Post::query()
            ->published()
            ->with(['category:id,name,slug', 'tags:id,name,slug'])
            ->latest('published_at')
            ->get();

        $request->attributes->set('seo', $siteSetting->seoData(
            "Blog {$siteSetting->site_name} | Insight Website & Aplikasi Makassar",
            'Artikel seputar jasa pembuatan aplikasi, website bisnis, SEO lokal Makassar, dan strategi digital untuk bisnis yang ingin berkembang.',
            route('blog'),
            [
                'blog jasa pembuatan aplikasi makassar',
                'artikel website bisnis makassar',
                'seo lokal makassar',
            ],
            [[
                '@context' => 'https://schema.org',
                '@type' => 'CollectionPage',
                'name' => "Blog {$siteSetting->site_name}",
                'url' => route('blog'),
                'description' => 'Kumpulan artikel strategi website, aplikasi web, dan SEO lokal Makassar.',
            ]],
        ));

        return Inertia::render('Blog', [
            'posts' => $posts->map(fn (Post $post): array => [
                'id' => $post->id,
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'coverImage' => $post->cover_image,
                'publishedAt' => $post->published_at?->format('F j, Y'),
                'category' => $post->category?->name,
                'tags' => $post->tags->pluck('name')->all(),
            ])->all(),
        ]);
    }

    public function show(Request $request, Post $post): Response
    {
        abort_unless($post->isPublished(), 404);

        $siteSetting = SiteSetting::current();

        $post->loadMissing(['author:id,name', 'category:id,name,slug', 'tags:id,name,slug']);

        $latestPosts = Post::query()
            ->published()
            ->whereKeyNot($post->id)
            ->with('category:id,name,slug')
            ->latest('published_at')
            ->take(3)
            ->get();

        $request->attributes->set('seo', $siteSetting->seoData(
            $post->seo_title ?: "{$post->title} | Blog {$siteSetting->site_name}",
            $post->seo_description ?: $post->excerpt,
            route('blog.show', $post->slug),
            array_filter([
                ...explode(',', (string) $post->seo_keywords),
                $post->category?->name,
                ...$post->tags->pluck('name')->all(),
                'jasa pembuatan aplikasi makassar',
            ]),
            [[
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $post->title,
                'description' => $post->seo_description ?: $post->excerpt,
                'datePublished' => $post->published_at?->toIso8601String(),
                'dateModified' => $post->updated_at->toIso8601String(),
                'author' => [
                    '@type' => 'Person',
                    'name' => $post->author?->name ?? 'Tim '.$siteSetting->site_name,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => $siteSetting->site_name,
                ],
                'image' => $post->cover_image ?: route('site-assets.show', ['asset' => 'logo']),
                'mainEntityOfPage' => route('blog.show', $post->slug),
            ]],
        ));

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
                'category' => $post->category?->name,
                'tags' => $post->tags->pluck('name')->all(),
            ],
            'latestPosts' => $latestPosts->map(fn (Post $relatedPost): array => [
                'id' => $relatedPost->id,
                'slug' => $relatedPost->slug,
                'title' => $relatedPost->title,
                'excerpt' => $relatedPost->excerpt,
                'coverImage' => $relatedPost->cover_image,
                'publishedAt' => $relatedPost->published_at?->format('F j, Y'),
                'category' => $relatedPost->category?->name,
                'tags' => [],
            ])->all(),
        ]);
    }
}
