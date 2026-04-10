<?php

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can view the blog cms dashboard', function () {
    $user = User::factory()->create();

    Post::factory()->for($user, 'author')->published()->create([
        'title' => 'Artikel Publish',
    ]);
    Post::factory()->for($user, 'author')->create([
        'title' => 'Artikel Draft',
    ]);

    $this->actingAs($user)
        ->get(route('cms.blog.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/blog/Index')
            ->where('stats.totalPosts', 2)
            ->where('stats.publishedPosts', 1)
            ->where('stats.draftPosts', 1)
            ->has('posts', 2)
        );
});

test('authenticated users can create a draft post from the cms', function () {
    $user = User::factory()->create();
    $category = BlogCategory::factory()->create();
    $tags = BlogTag::factory()->count(2)->create();

    $this->actingAs($user)
        ->post(route('cms.blog.store'), [
            'title' => 'Strategi Website untuk Klinik Kecil',
            'slug' => 'Strategi Website untuk Klinik Kecil',
            'excerpt' => 'Panduan singkat untuk membuat website klinik terlihat lebih terpercaya di mata calon pasien lokal.',
            'content' => str_repeat('Konten artikel yang cukup panjang untuk lolos validasi. ', 3),
            'cover_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1600&q=80',
            'status' => 'draft',
            'category_id' => $category->id,
            'tag_ids' => $tags->pluck('id')->all(),
            'seo_title' => 'Strategi Website untuk Klinik Kecil | Blog Frametech',
            'seo_description' => 'Tips membuat website klinik yang lebih meyakinkan untuk pasien lokal.',
            'seo_keywords' => 'website klinik, jasa website makassar',
        ])
        ->assertRedirect();

    $this->assertDatabaseHas('posts', [
        'title' => 'Strategi Website untuk Klinik Kecil',
        'slug' => 'strategi-website-untuk-klinik-kecil',
        'status' => 'draft',
        'author_id' => $user->id,
        'category_id' => $category->id,
    ]);
});

test('authenticated users can publish an existing post', function () {
    $user = User::factory()->create();
    $category = BlogCategory::factory()->create();
    $tag = BlogTag::factory()->create();
    $post = Post::factory()->for($user, 'author')->create([
        'status' => 'draft',
        'published_at' => null,
    ]);

    $this->actingAs($user)
        ->put(route('cms.blog.update', $post), [
            'title' => 'Artikel yang Siap Publish',
            'slug' => 'artikel-yang-siap-publish',
            'excerpt' => 'Ringkasan artikel yang memberi konteks jelas sebelum pembaca membuka isi lengkap tulisan.',
            'content' => str_repeat('Isi artikel publish yang memadai untuk kebutuhan validasi. ', 3),
            'cover_image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80',
            'status' => 'published',
            'category_id' => $category->id,
            'tag_ids' => [$tag->id],
            'seo_title' => 'Artikel yang Siap Publish | Blog Frametech',
            'seo_description' => 'Artikel publish dengan metadata SEO lengkap.',
            'seo_keywords' => 'artikel publish, blog bisnis',
        ])
        ->assertRedirect(route('cms.blog.edit', $post));

    $post->refresh();

    expect($post->status)->toBe('published');
    expect($post->published_at)->not->toBeNull();
    expect($post->category_id)->toBe($category->id);
    expect($post->tags()->count())->toBe(1);
    expect($post->seo_title)->toBe('Artikel yang Siap Publish | Blog Frametech');
});

test('authenticated users can delete a post from the cms', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user, 'author')->create();

    $this->actingAs($user)
        ->delete(route('cms.blog.destroy', $post))
        ->assertRedirect(route('cms.blog.index'));

    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});
