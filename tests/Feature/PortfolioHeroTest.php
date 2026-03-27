<?php

it('uses the portfolio hero image asset in the landing component', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/PortfolioHero.vue'));

    expect($component)
        ->toContain('src="/images/landing/hero-portfolio.png"')
        ->toContain('alt="Contoh tampilan website portofolio yang dibuat Frametech"')
        ->toContain('bottom-[-36px]')
        ->toContain('w-[min(420px,84%)]')
        ->toContain('sm:w-[min(470px,82%)]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]')
        ->not->toContain('src="/images/landing/hero-person.svg"')
        ->toContain('BriefcaseBusiness')
        ->toContain('LayoutPanelTop')
        ->toContain('Camera')
        ->toContain('MessageCircleMore');
});
