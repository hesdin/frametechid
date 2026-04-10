<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
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
            'business_name' => fake()->company(),
            'phone_number' => '08'.fake()->numerify('##########'),
            'email' => fake()->safeEmail(),
            'service_interest' => fake()->randomElement([
                'Jasa Pembuatan Aplikasi Web',
                'Company Profile Website',
                'Landing Page Promosi',
            ]),
            'message' => fake()->paragraph(),
            'status' => fake()->randomElement(Lead::statuses()),
            'source' => 'website',
            'notes' => fake()->boolean() ? fake()->sentence() : null,
            'contacted_at' => fake()->boolean(60) ? now()->subHours(fake()->numberBetween(1, 72)) : null,
        ];
    }
}
