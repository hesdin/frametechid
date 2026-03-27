<?php

it('renders the about page with the frametech brand theme', function (): void {
    $this->get(route('about'))
        ->assertSuccessful();

    $aboutPage = file_get_contents(resource_path('js/pages/About.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/AboutHero.vue'));
    $reasonsComponent = file_get_contents(resource_path('js/components/landing/AboutReasons.vue'));

    expect($aboutPage)
        ->toContain('<Navbar current-page="about" theme="brand" />')
        ->toContain('background-class="bg-[#f5f9fd]"')
        ->toContain('theme="brand"')
        ->toContain('theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('from-[#2c87c9] to-[#176aaf]');

    expect($reasonsComponent)
        ->toContain('bg-[linear-gradient(180deg,#f5f9fd_0%,#fff8ea_100%)]')
        ->toContain('border border-[#dce8f4]')
        ->toContain('from-[#2c87c9] to-[#176aaf]');
});
