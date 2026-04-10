<?php

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage blog categories and tags from the cms', function () {
    $user = User::factory()->create();
    $category = BlogCategory::factory()->create();
    $tag = BlogTag::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.blog-categories.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/blog-categories/Index')
            ->has('categories', 1)
        );

    $this->get(route('cms.blog-tags.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/blog-tags/Index')
            ->has('tags', 1)
        );

    $this->post(route('cms.blog-categories.store'), [
        'name' => 'SEO Lokal Makassar',
        'slug' => 'seo-lokal-makassar',
        'description' => 'Konten untuk target keyword bisnis lokal Makassar.',
        'seo_title' => 'SEO Lokal Makassar | Blog Frametech',
        'seo_description' => 'Panduan SEO lokal untuk bisnis Makassar.',
    ])->assertRedirect(route('cms.blog-categories.index'));

    $this->post(route('cms.blog-tags.store'), [
        'name' => 'Makassar',
        'slug' => 'makassar',
    ])->assertRedirect(route('cms.blog-tags.index'));

    $this->put(route('cms.blog-categories.update', $category), [
        'name' => 'Aplikasi Web',
        'slug' => 'aplikasi-web',
        'description' => 'Topik aplikasi web custom.',
        'seo_title' => 'Aplikasi Web | Blog Frametech',
        'seo_description' => 'Insight pengembangan aplikasi web.',
    ])->assertRedirect(route('cms.blog-categories.index'));

    $this->put(route('cms.blog-tags.update', $tag), [
        'name' => 'SEO',
        'slug' => 'seo',
    ])->assertRedirect(route('cms.blog-tags.index'));

    expect(BlogCategory::query()->where('slug', 'seo-lokal-makassar')->exists())->toBeTrue();
    expect(BlogTag::query()->where('slug', 'makassar')->exists())->toBeTrue();
});
