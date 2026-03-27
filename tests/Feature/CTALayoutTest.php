<?php

it('keeps the CTA illustration above overlapping text cards', function (): void {
    $component = file_get_contents(resource_path('js/components/landing/CTA.vue'));

    expect($component)
        ->toContain('class="absolute inset-x-10 top-1/2 z-20 w-[500px] -translate-y-1/2 object-contain"')
        ->toContain('class="absolute top-8 left-0 z-10 inline-flex min-w-[380px]')
        ->toContain('class="absolute right-6 bottom-10 z-10 inline-flex min-w-[320px]')
        ->not->toContain('absolute inset-0 z-0 rounded-[34px]');
});
