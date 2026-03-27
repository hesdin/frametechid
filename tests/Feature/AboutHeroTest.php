<?php

it('uses the about hero image asset in the right-side visual', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/AboutHero.vue'));

    expect($component)
        ->toContain('src="/images/landing/hero-tentang-kami.png"')
        ->toContain('alt="Tampilan halaman tentang kami Frametech"')
        ->toContain('bottom-[-36px]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]')
        ->toContain('w-[112%] max-w-[980px] -translate-x-1/2 object-contain')
        ->toContain('BriefcaseBusiness')
        ->toContain('Lightbulb')
        ->toContain('Rocket')
        ->not->toContain('src="/images/landing/hero-person.svg"')
        ->not->toContain('src="/images/landing/consultant.svg"');
});
