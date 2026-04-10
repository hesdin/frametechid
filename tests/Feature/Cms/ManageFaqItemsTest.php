<?php

use App\Models\FaqItem;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can manage faq items from the cms', function () {
    $user = User::factory()->create();
    $faqItem = FaqItem::factory()->create();

    $this->actingAs($user)
        ->get(route('cms.faqs.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/faqs/Index')
            ->has('stats')
            ->has('faqItems', 1)
        );

    $this->post(route('cms.faqs.store'), [
        'question' => 'Apakah bisa revisi desain?',
        'answer' => 'Bisa, revisi dilakukan pada tahap yang disepakati agar proyek tetap terarah.',
        'sort_order' => 2,
        'is_published' => true,
    ])->assertRedirect(route('cms.faqs.index'));

    $this->put(route('cms.faqs.update', $faqItem), [
        'question' => 'Apakah website bisa mobile friendly?',
        'answer' => 'Ya, semua halaman dibuat responsif agar nyaman digunakan di HP dan desktop.',
        'sort_order' => 3,
        'is_published' => false,
    ])->assertRedirect(route('cms.faqs.index'));

    expect(FaqItem::query()->where('question', 'Apakah bisa revisi desain?')->exists())->toBeTrue();
    expect($faqItem->fresh()->is_published)->toBeFalse();

    $this->delete(route('cms.faqs.destroy', $faqItem))
        ->assertRedirect(route('cms.faqs.index'));

    expect(FaqItem::query()->whereKey($faqItem->id)->exists())->toBeFalse();
});
