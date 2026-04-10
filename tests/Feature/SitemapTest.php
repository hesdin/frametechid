<?php

use App\Models\Post;

test('sitemap includes core pages and published blog posts only', function (): void {
    $publishedPost = Post::factory()->published()->create([
        'slug' => 'jasa-pembuatan-aplikasi-makassar',
    ]);
    $draftPost = Post::factory()->create([
        'slug' => 'draft-jangan-terindex',
    ]);

    $response = $this->get(route('sitemap'));

    $response->assertSuccessful();
    expect($response->headers->get('Content-Type'))->toContain('application/xml');
    $response->assertSee('<urlset', false);
    $response->assertSee(route('home'), false);
    $response->assertSee(route('services'), false);
    $response->assertSee(route('pricing'), false);
    $response->assertSee(route('portfolio'), false);
    $response->assertSee(route('about'), false);
    $response->assertSee(route('blog'), false);
    $response->assertSee(route('blog.show', $publishedPost->slug), false);
    $response->assertDontSee(route('blog.show', $draftPost->slug), false);
});

test('robots file references sitemap location', function (): void {
    $response = $this->get(route('robots'));

    $response->assertSuccessful();
    expect($response->headers->get('Content-Type'))->toContain('text/plain');
    $response->assertSee('User-agent: *', false);
    $response->assertSee('Allow: /', false);
    $response->assertSee('Sitemap: '.route('sitemap'), false);
});
