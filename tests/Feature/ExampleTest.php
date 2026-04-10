<?php

use App\Models\Post;

it('renders marketing pages successfully', function (string $routeName, array $parameters = []) {
    if ($routeName === 'blog.show') {
        $post = Post::factory()->published()->create();

        $parameters = [
            'post' => $post->slug,
        ];
    }

    $this->get(route($routeName, $parameters))->assertSuccessful();
})->with([
    'home' => ['home'],
    'services' => ['services'],
    'pricing' => ['pricing'],
    'portfolio' => ['portfolio'],
    'about' => ['about'],
    'blog' => ['blog'],
    'blog show' => ['blog.show'],
]);
