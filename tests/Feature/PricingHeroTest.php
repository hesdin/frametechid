<?php

it('uses the pricing hero illustration asset in the landing component', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/PricingHero.vue'));

    expect($component)
        ->toContain('src="/images/landing/hero-paket-harga.png"')
        ->toContain('bottom-[-36px]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]')
        ->not->toContain('src="/images/landing/hero-person.svg"');
});
