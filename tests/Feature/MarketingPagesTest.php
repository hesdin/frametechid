<?php

use App\Models\PortfolioItem;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\SiteSetting;
use Inertia\Testing\AssertableInertia as Assert;

test('marketing pages render cms driven content and seo metadata', function () {
    SiteSetting::query()->updateOrCreate(
        ['id' => 1],
        array_merge(SiteSetting::defaults(), [
            'seo_title' => 'Frametech | Jasa Pembuatan Website & Aplikasi Makassar',
            'seo_description' => 'Frametech membantu bisnis Makassar memiliki website dan aplikasi web yang siap tumbuh.',
        ]),
    );

    Service::factory()->create([
        'title' => 'Jasa Pembuatan Aplikasi Web',
        'slug' => 'jasa-pembuatan-aplikasi-web',
        'is_featured' => true,
        'sort_order' => 1,
    ]);

    PricingPlan::factory()->create([
        'name' => 'Paket Growth',
        'slug' => 'paket-growth',
        'is_featured' => true,
        'sort_order' => 1,
    ]);

    PortfolioItem::factory()->create([
        'title' => 'Makassar Booking Suite',
        'slug' => 'makassar-booking-suite',
        'is_featured' => true,
        'sort_order' => 1,
    ]);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('application/ld+json', false)
        ->assertSee('jasa pembuatan aplikasi makassar', false)
        ->assertInertia(fn (Assert $page) => $page
            ->component('Landing')
            ->has('featuredServices')
            ->has('featuredPortfolioItems')
            ->has('seo')
        );

    $this->get(route('services'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Services')
            ->has('services')
            ->has('pricingPlans')
            ->has('seo')
        );

    $this->get(route('pricing'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Pricing')
            ->has('plans')
            ->has('seo')
        );

    $this->get(route('portfolio'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('PortfolioIndex')
            ->has('items')
            ->has('seo')
        );
});
