<?php

use App\Models\Lead;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can review and update leads from the cms', function () {
    $user = User::factory()->create();
    $lead = Lead::factory()->create([
        'status' => Lead::STATUS_NEW,
    ]);

    $this->actingAs($user)
        ->get(route('cms.leads.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/leads/Index')
            ->has('stats')
            ->has('leads', 1)
        );

    $this->get(route('cms.leads.edit', $lead))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/leads/Edit')
            ->where('lead.id', $lead->id)
        );

    $this->put(route('cms.leads.update', $lead), [
        'status' => Lead::STATUS_QUALIFIED,
        'notes' => 'Prospek bagus, minta follow up proposal minggu ini.',
    ])->assertRedirect(route('cms.leads.index'));

    expect($lead->fresh()->status)->toBe(Lead::STATUS_QUALIFIED);
    expect($lead->fresh()->contacted_at)->not->toBeNull();
});
