<?php

use App\Models\Testimonial;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage testimonials from the cms', function () {
    $user = User::factory()->create();
    $testimonial = Testimonial::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.testimonials.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/testimonials/Index')
            ->has('stats')
            ->has('testimonials', 1)
        );

    $this->post(route('cms.testimonials.store'), [
        'name' => 'Dian Makmur',
        'role' => 'Owner Klinik Makassar',
        'quote' => 'Tim sangat rapi, cepat, dan paham alur bisnis kami.',
        'avatar_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=320&q=80',
        'rating' => 5,
        'sort_order' => 2,
        'is_published' => true,
    ])->assertRedirect(route('cms.testimonials.index'));

    $this->put(route('cms.testimonials.update', $testimonial), [
        'name' => 'Ayu Digital',
        'role' => 'Founder Studio Konten',
        'quote' => 'Website baru kami lebih meyakinkan dan lead yang masuk jauh lebih rapi.',
        'avatar_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=320&q=80',
        'rating' => 4,
        'sort_order' => 3,
        'is_published' => false,
    ])->assertRedirect(route('cms.testimonials.index'));

    expect(Testimonial::query()->where('name', 'Dian Makmur')->exists())->toBeTrue();
    expect($testimonial->fresh()->is_published)->toBeFalse();

    $this->delete(route('cms.testimonials.destroy', $testimonial))
        ->assertRedirect(route('cms.testimonials.index'));

    expect(Testimonial::query()->whereKey($testimonial->id)->exists())->toBeFalse();
});
