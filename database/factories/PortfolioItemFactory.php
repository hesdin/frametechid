<?php

namespace Database\Factories;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PortfolioItem>
 */
class PortfolioItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->company();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'client_name' => $title,
            'industry' => fake()->randomElement(['Kuliner', 'Teknik', 'Kesehatan', 'Pendidikan']),
            'location' => fake()->randomElement(['Makassar', 'Gowa', 'Maros']),
            'summary' => fake()->sentence(20),
            'live_url' => fake()->optional()->url(),
            'desktop_image_url' => 'https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1800&q=80',
            'mobile_image_url' => 'https://images.unsplash.com/photo-1598128558393-70ff21433be0?auto=format&fit=crop&w=900&q=80',
            'sort_order' => fake()->numberBetween(1, 20),
            'is_featured' => fake()->boolean(),
            'is_published' => true,
        ];
    }
}
