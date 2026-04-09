<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->randomElement([
            'Jasa Pembuatan Website UMKM',
            'Landing Page Promosi',
            'Company Profile Website',
            'Jasa Pembuatan Aplikasi Web',
        ]);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->sentence(16),
            'icon_key' => fake()->randomElement([
                'store',
                'building-2',
                'shopping-cart',
                'megaphone',
                'monitor-smartphone',
                'layout-grid',
            ]),
            'sort_order' => fake()->numberBetween(1, 20),
            'is_featured' => fake()->boolean(),
            'is_active' => true,
        ];
    }
}
