<?php

it('uses a slimmer why choose visual with social and play accent icons', function (): void {
    $this->get(route('home'))
        ->assertSuccessful();

    $component = file_get_contents(resource_path('js/components/landing/WhyChoose.vue'));

    expect($component)
        ->toContain('min-h-[420px]')
        ->toContain('w-[60%]')
        ->toContain('pt-10')
        ->toContain('Instagram')
        ->toContain('Linkedin')
        ->toContain('Facebook')
        ->not->toContain('CirclePlay')
        ->not->toContain('🇺🇸')
        ->not->toContain('🇫🇷')
        ->not->toContain('🇦🇺');
});
