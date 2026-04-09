<?php

use App\Models\PricingPlan;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage pricing plans from the cms', function () {
    $user = User::factory()->create();
    $plan = PricingPlan::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.pricing.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/pricing/Index')
            ->has('stats')
            ->has('plans', 1)
        );

    $this->post(route('cms.pricing.store'), [
        'name' => 'Paket Corporate',
        'slug' => 'paket-corporate',
        'summary' => 'Paket untuk perusahaan yang membutuhkan website dan kebutuhan aplikasi web yang lebih kompleks.',
        'previous_price' => 'Rp15.000.000',
        'price' => 'Rp10.000.000',
        'discount_label' => 'Diskon 33%',
        'note' => 'Cocok untuk sistem internal dan website marketing yang berjalan bersamaan.',
        'cta_label' => 'Konsultasi Sekarang',
        'featuresText' => "Website company profile\nDashboard admin\nSEO lokal Makassar",
        'icon_letter' => 'C',
        'accent_tone' => 'blue',
        'sort_order' => 4,
        'is_featured' => true,
        'is_active' => true,
    ])->assertRedirect(route('cms.pricing.index'));

    $plan->refresh();

    $this->put(route('cms.pricing.update', $plan), [
        'name' => 'Paket Growth',
        'slug' => 'paket-growth',
        'summary' => 'Paket menengah untuk bisnis yang aktif promosi.',
        'previous_price' => 'Rp6.500.000',
        'price' => 'Rp4.500.000',
        'discount_label' => 'Diskon 31%',
        'note' => 'Paket paling seimbang.',
        'cta_label' => 'Pilih Paket Ini',
        'featuresText' => "Company profile lengkap\nSEO lokal\nWhatsApp CTA",
        'icon_letter' => 'G',
        'accent_tone' => 'silver',
        'sort_order' => 2,
        'is_featured' => true,
        'is_active' => true,
    ])->assertRedirect(route('cms.pricing.index'));

    expect(PricingPlan::query()->where('slug', 'paket-corporate')->exists())->toBeTrue();
    $updatedPlan = $plan->fresh();

    expect($updatedPlan->accent_tone)->toBe('silver');
    expect($updatedPlan->features)->toBe([
        'Company profile lengkap',
        'SEO lokal',
        'WhatsApp CTA',
    ]);

    $this->delete(route('cms.pricing.destroy', $plan))
        ->assertRedirect(route('cms.pricing.index'));

    expect(PricingPlan::query()->whereKey($plan->id)->exists())->toBeFalse();
});
