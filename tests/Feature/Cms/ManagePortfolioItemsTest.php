<?php

use App\Models\PortfolioItem;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage portfolio items from the cms', function () {
    $user = User::factory()->create();
    $item = PortfolioItem::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.portfolio.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/portfolio/Index')
            ->has('stats')
            ->has('items', 1)
        );

    $this->post(route('cms.portfolio.store'), [
        'title' => 'Makassar CRM Suite',
        'slug' => 'makassar-crm-suite',
        'client_name' => 'Makassar CRM Suite',
        'industry' => 'Aplikasi Web',
        'location' => 'Makassar',
        'summary' => 'Dashboard CRM untuk memantau leads, follow up, dan pipeline penjualan.',
        'live_url' => 'https://example.com/makassar-crm-suite',
        'desktop_image_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1800&q=80',
        'mobile_image_url' => 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=900&q=80',
        'sort_order' => 2,
        'is_featured' => true,
        'is_published' => true,
    ])->assertRedirect(route('cms.portfolio.index'));

    $item->refresh();

    $this->put(route('cms.portfolio.update', $item), [
        'title' => 'Website Klinik Makassar',
        'slug' => 'website-klinik-makassar',
        'client_name' => 'Harmoni Clinic',
        'industry' => 'Kesehatan',
        'location' => 'Makassar',
        'summary' => 'Website klinik dengan fokus trust dan layanan unggulan.',
        'live_url' => 'https://example.com/harmoni-clinic',
        'desktop_image_url' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1800&q=80',
        'mobile_image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=80',
        'sort_order' => 3,
        'is_featured' => false,
        'is_published' => true,
    ])->assertRedirect(route('cms.portfolio.index'));

    expect(PortfolioItem::query()->where('slug', 'makassar-crm-suite')->exists())->toBeTrue();
    expect($item->fresh()->industry)->toBe('Kesehatan');

    $this->delete(route('cms.portfolio.destroy', $item))
        ->assertRedirect(route('cms.portfolio.index'));

    expect(PortfolioItem::query()->whereKey($item->id)->exists())->toBeFalse();
});
