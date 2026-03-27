<?php

it('keeps the CTA illustration above overlapping text cards', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/CTA.vue'));

    expect($component)
        ->toContain('class="pointer-events-none absolute bottom-[-44px] left-[53%] z-20 w-[460px] -translate-x-1/2 object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]"')
        ->toContain('class="absolute top-8 left-[-36px] z-10 inline-flex min-w-[380px]')
        ->toContain('class="absolute right-2 bottom-[-10px] z-30 inline-flex min-w-[320px]')
        ->not->toContain('absolute inset-0 z-0 rounded-[34px]');
});
