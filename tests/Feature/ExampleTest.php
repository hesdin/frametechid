<?php

it('renders marketing pages successfully', function (string $routeName, array $parameters = []) {
    $this->get(route($routeName, $parameters))->assertSuccessful();
})->with([
    'home' => ['home'],
    'services' => ['services'],
    'pricing' => ['pricing'],
    'portfolio' => ['portfolio'],
    'about' => ['about'],
    'blog' => ['blog'],
    'blog show' => [
        'blog.show',
        [
            'slug' => 'pembuatan-website-umkm-cara-bisnis-lokal-scale-up-dan-perluas-market-di-2026',
        ],
    ],
]);
