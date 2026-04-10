<?php

namespace Database\Factories;

use App\Models\FaqItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FaqItem>
 */
class FaqItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence(fake()->numberBetween(5, 8)),
            'answer' => fake()->paragraph(fake()->numberBetween(2, 3)),
            'sort_order' => fake()->numberBetween(1, 12),
            'is_published' => true,
        ];
    }
}
