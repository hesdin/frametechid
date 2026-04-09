<?php

use App\Models\Service;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage services from the cms', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.services.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/services/Index')
            ->has('stats')
            ->has('services', 1)
        );

    $this->post(route('cms.services.store'), [
        'title' => 'Jasa SEO Lokal Makassar',
        'slug' => 'jasa-seo-lokal-makassar',
        'description' => 'Optimasi halaman bisnis agar lebih mudah ditemukan di Google Maps dan pencarian lokal.',
        'icon_key' => 'layout-grid',
        'sort_order' => 2,
        'is_featured' => true,
        'is_active' => true,
    ])->assertRedirect(route('cms.services.index'));

    $service->refresh();

    $this->put(route('cms.services.update', $service), [
        'title' => 'Company Profile Website',
        'slug' => 'company-profile-website',
        'description' => 'Website profil perusahaan yang lebih lengkap untuk brand profesional.',
        'icon_key' => 'building-2',
        'sort_order' => 3,
        'is_featured' => false,
        'is_active' => true,
    ])->assertRedirect(route('cms.services.index'));

    expect(Service::query()->where('slug', 'jasa-seo-lokal-makassar')->exists())->toBeTrue();
    expect($service->fresh()->icon_key)->toBe('building-2');

    $this->delete(route('cms.services.destroy', $service))
        ->assertRedirect(route('cms.services.index'));

    expect(Service::query()->whereKey($service->id)->exists())->toBeFalse();
});
