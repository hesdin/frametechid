<?php

it('renders the services page with the frametech brand theme', function (): void {
    $this->get(route('services'))
        ->assertSuccessful();

    $servicesPage = file_get_contents(resource_path('js/pages/Services.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/ServicesHero.vue'));
    $gridComponent = file_get_contents(resource_path('js/components/landing/ServicesGrid.vue'));
    $pricingComponent = file_get_contents(resource_path('js/components/landing/ServicesPricing.vue'));

    expect($servicesPage)
        ->toContain('<Navbar current-page="services" theme="brand" />')
        ->toContain('theme="brand" />')
        ->toContain('accent-theme="brand"')
        ->toContain('<CTA theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('from-[#2c87c9] to-[#176aaf]')
        ->toContain('bottom-[-36px]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]');

    expect($gridComponent)
        ->toContain('bg-[linear-gradient(180deg,#f5f9fd_0%,#ffffff_100%)]')
        ->toContain('border border-[#dce8f4]')
        ->toContain('from-[#2c87c9] to-[#176aaf]');

    expect($pricingComponent)
        ->toContain('bg-[linear-gradient(180deg,#fff8ea_0%,#f3f9fd_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('bg-[linear-gradient(180deg,#eef7fd_0%,#fff3da_100%)]');
});
