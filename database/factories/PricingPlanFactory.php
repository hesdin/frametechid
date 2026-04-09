<?php

namespace Database\Factories;

use App\Models\PricingPlan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PricingPlan>
 */
class PricingPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Paket Start',
            'Paket Growth',
            'Paket Signature',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => fake()->sentence(18),
            'previous_price' => 'Rp'.fake()->numberBetween(3000000, 11000000),
            'price' => 'Rp'.fake()->numberBetween(1500000, 8500000),
            'discount_label' => 'Diskon '.fake()->numberBetween(20, 50).'%',
            'note' => fake()->sentence(),
            'cta_label' => 'Pilih Paket',
            'features' => fake()->sentences(4),
            'icon_letter' => Str::substr($name, 0, 1),
            'accent_tone' => fake()->randomElement(['bronze', 'silver', 'gold']),
            'sort_order' => fake()->numberBetween(1, 10),
            'is_featured' => fake()->boolean(),
            'is_active' => true,
        ];
    }
}
