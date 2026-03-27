<?php

it('uses the local about story image asset', function (): void {
    $this->get(route('about'))
        ->assertSuccessful();

    $component = file_get_contents(resource_path('js/components/landing/AboutStory.vue'));

    expect($component)
        ->toContain('src="/images/landing/tentang-kami-1.png"')
        ->toContain('alt="Tim Frametech berdiskusi untuk membantu bisnis lokal"')
        ->not->toContain('images.unsplash.com/photo-1517048676732-d65bc937f952');
});
