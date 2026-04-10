<?php

namespace Database\Factories;

use App\Models\MediaAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MediaAsset>
 */
class MediaAssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'alt_text' => fake()->sentence(),
            'file_path' => 'media-library/'.fake()->uuid().'.png',
            'disk' => 'public',
            'mime_type' => 'image/png',
            'file_size' => fake()->numberBetween(20_000, 1_500_000),
        ];
    }
}
