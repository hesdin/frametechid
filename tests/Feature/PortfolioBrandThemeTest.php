<?php

it('renders the portfolio page with the frametech brand theme', function (): void {
    $this->get(route('portfolio'))
        ->assertSuccessful();

    $portfolioPage = file_get_contents(resource_path('js/pages/PortfolioIndex.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/PortfolioHero.vue'));
    $galleryComponent = file_get_contents(resource_path('js/components/landing/PortfolioGallery.vue'));

    expect($portfolioPage)
        ->toContain('<Navbar current-page="portfolio" theme="brand" />')
        ->toContain('<ProcessSteps section-id="proses" theme="brand" />')
        ->toContain('theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('from-[#eda40f] to-[#d98700]')
        ->toContain('from-[#2c87c9] to-[#176aaf]');

    expect($galleryComponent)
        ->toContain('bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)]')
        ->toContain('border border-[#dce8f4]')
        ->toContain('bg-[#eef5fb]');
});
