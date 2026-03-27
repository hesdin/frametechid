<?php

it('uses the updated mission image asset and brand hashtag color', function (): void {
    $this->get(route('about'))
        ->assertSuccessful();

    $component = file_get_contents(resource_path('js/components/landing/AboutMission.vue'));

    expect($component)
        ->toContain('src="/images/landing/tentang-kami-2.png"')
        ->toContain('alt="Tim Frametech mendampingi bisnis lokal go digital"')
        ->toContain('text-[#dd8800]')
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('repeating-radial-gradient(circle_at_62%_44%,rgba(34,122,186,0.08)_0_1px,transparent_1px_9px)')
        ->toContain('min-h-[340px]')
        ->toContain('bottom-[-42px]')
        ->toContain('w-[118%]')
        ->toContain('[mask-image:linear-gradient(to_bottom,black_0%,black_72%,rgba(0,0,0,0.92)_82%,transparent_100%)]')
        ->not->toContain('src="/images/landing/hero-person.svg"')
        ->not->toContain('src="/images/landing/consultant.svg"');
});
