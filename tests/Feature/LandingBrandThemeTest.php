<?php

it('renders the landing page with the frametech brand theme', function (): void {
    $this->get(route('home'))
        ->assertSuccessful();

    $landingPage = file_get_contents(resource_path('js/pages/Landing.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/Hero.vue'));
    $navbarComponent = file_get_contents(resource_path('js/components/landing/Navbar.vue'));

    expect($landingPage)
        ->toContain('<Navbar current-page="home" theme="brand" />')
        ->toContain('<Features theme="brand" />')
        ->toContain('accent-theme="brand"')
        ->toContain('<CTA theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('from-[#2c87c9] to-[#176aaf]');

    expect($navbarComponent)
        ->toContain("theme?: 'blue' | 'red' | 'brand';")
        ->toContain('src="/images/landing/logo-frametech.png"')
        ->toContain("isBrandTheme = computed(() => props.theme === 'brand')");
});
