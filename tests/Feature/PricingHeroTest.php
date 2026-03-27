<?php

it('uses the pricing hero illustration asset in the landing component', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/PricingHero.vue'));

    expect($component)
        ->toContain('src="/images/landing/hero-paket-harga.png"')
        ->toContain('class="absolute bottom-0 left-1/2 z-[3] w-[min(430px,82%)] -translate-x-1/2"')
        ->not->toContain('src="/images/landing/hero-person.svg"');
});
