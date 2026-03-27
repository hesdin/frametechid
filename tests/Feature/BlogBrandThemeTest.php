<?php

it('renders the blog page with the frametech brand theme', function (): void {
    $this->get(route('blog'))
        ->assertSuccessful();

    $blogPage = file_get_contents(resource_path('js/pages/Blog.vue'));
    $heroComponent = file_get_contents(resource_path('js/components/landing/BlogHero.vue'));
    $postsComponent = file_get_contents(resource_path('js/components/landing/BlogPosts.vue'));

    expect($blogPage)
        ->toContain('<Navbar current-page="blog" theme="brand" />')
        ->toContain('theme="brand" />')
        ->toContain('<Footer theme="brand" />');

    expect($heroComponent)
        ->toContain('bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]')
        ->toContain('rgba(33,119,184,0.18)')
        ->toContain('rgba(246,170,26,0.16)');

    expect($postsComponent)
        ->toContain('bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)]')
        ->toContain('border border-[#dce8f4]')
        ->toContain('bg-[#eef5fb]');
});
