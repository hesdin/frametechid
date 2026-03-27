<?php

it('uses the about hero image asset in the right-side visual', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/AboutHero.vue'));

    expect($component)
        ->toContain('src="/images/landing/hero-tentang-kami.png"')
        ->toContain('alt="Tampilan halaman tentang kami Frametech"')
        ->toContain('w-[112%] max-w-[980px] -translate-x-1/2 object-contain sm:w-[118%] lg:w-[124%]')
        ->toContain('BriefcaseBusiness')
        ->toContain('Lightbulb')
        ->toContain('Rocket')
        ->not->toContain('src="/images/landing/hero-person.svg"')
        ->not->toContain('src="/images/landing/consultant.svg"');
});
