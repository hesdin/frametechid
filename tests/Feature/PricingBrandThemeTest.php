<?php

it('renders the pricing page with the frametech brand theme', function (): void {
    $this->get(route('pricing'))
        ->assertSuccessful();

    $pricingPage = file_get_contents(resource_path('js/pages/Pricing.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/PricingHero.vue'));
    $plansComponent = file_get_contents(resource_path('js/components/landing/PricingPlans.vue'));

    expect($pricingPage)
        ->toContain('<Navbar current-page="pricing" theme="brand" />')
        ->toContain('<ProcessSteps section-id="proses" theme="brand" />')
        ->toContain('theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('from-[#2c87c9] to-[#176aaf]')
        ->toContain('bottom-[-36px]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]');

    expect($plansComponent)
        ->toContain('bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)]')
        ->toContain('text-[#1f79bc]')
        ->toContain('bg-[#fff5e5]')
        ->toContain('bg-[#eef5fc]')
        ->toContain('from-[#eda40f] to-[#d98700]');
});
