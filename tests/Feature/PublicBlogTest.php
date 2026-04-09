<?php

use App\Models\Post;
use Inertia\Testing\AssertableInertia as Assert;

test('blog page only shows published posts', function () {
    $publishedPost = Post::factory()->published()->create([
        'title' => 'Artikel Publish',
        'slug' => 'artikel-publish',
    ]);
    $draftPost = Post::factory()->create([
        'title' => 'Artikel Draft',
        'slug' => 'artikel-draft',
    ]);

    $this->get(route('blog'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Blog')
            ->has('posts', 1)
            ->where('posts.0.slug', $publishedPost->slug)
            ->where('posts.0.title', $publishedPost->title)
        );

    expect($draftPost->isPublished())->toBeFalse();
});

test('published blog posts can be viewed publicly', function () {
    $post = Post::factory()->published()->create([
        'title' => 'Artikel Publik',
        'slug' => 'artikel-publik',
    ]);

    $this->get(route('blog.show', $post->slug))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('BlogShow')
            ->where('post.slug', $post->slug)
            ->where('post.title', $post->title)
        );
});

test('draft blog posts are not accessible publicly', function () {
    $post = Post::factory()->create([
        'slug' => 'draft-blog-post',
    ]);

    $this->get(route('blog.show', $post->slug))
        ->assertNotFound();
});
