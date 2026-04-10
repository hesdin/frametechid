<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->randomElement([
                'Owner UMKM Kuliner Makassar',
                'Direktur Perusahaan Lokal',
                'Founder Startup',
                'Manajer Operasional',
            ]),
            'quote' => fake()->paragraph(),
            'avatar_url' => sprintf(
                'https://images.unsplash.com/photo-%s?auto=format&fit=crop&w=320&q=80',
                fake()->randomElement([
                    '1527980965255-d3b416303d12',
                    '1500648767791-00dcc994a43e',
                    '1507003211169-0a1dd7228f2d',
                    '1494790108377-be9c29b29330',
                ]),
            ),
            'rating' => fake()->numberBetween(4, 5),
            'sort_order' => fake()->numberBetween(1, 12),
            'is_published' => true,
        ];
    }
}
