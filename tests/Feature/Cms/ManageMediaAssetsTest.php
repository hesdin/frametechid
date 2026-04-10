<?php

use App\Models\MediaAsset;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can upload and update media assets from the cms', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $asset = MediaAsset::factory()->create([
        'file_path' => 'media-library/existing.png',
        'disk' => 'public',
    ]);

    Storage::disk('public')->put('media-library/existing.png', 'old');

    $this->actingAs($user)
        ->get(route('cms.media.index'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('cms/media/Index')
            ->has('mediaAssets', 1)
        );

    $this->post(route('cms.media.store'), [
        'title' => 'Hero Banner',
        'alt_text' => 'Banner jasa pembuatan aplikasi',
        'file' => UploadedFile::fake()->image('hero-banner.png', 1200, 800),
    ])->assertRedirect(route('cms.media.index'));

    $this->post(route('cms.media.update', $asset), [
        '_method' => 'put',
        'title' => 'Updated Asset',
        'alt_text' => 'Asset diperbarui',
        'file' => UploadedFile::fake()->image('updated-asset.png', 800, 600),
    ])->assertRedirect(route('cms.media.index'));

    expect(MediaAsset::query()->where('title', 'Hero Banner')->exists())->toBeTrue();
    expect($asset->fresh()->title)->toBe('Updated Asset');

    $this->delete(route('cms.media.destroy', $asset))
        ->assertRedirect(route('cms.media.index'));

    expect(MediaAsset::query()->whereKey($asset->id)->exists())->toBeFalse();
});
