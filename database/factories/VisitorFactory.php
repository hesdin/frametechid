<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstVisitedAt = fake()->dateTimeBetween('-30 days', '-1 minute');

        return [
            'visitor_token' => fake()->uuid(),
            'first_visited_at' => $firstVisitedAt,
            'last_visited_at' => fake()->dateTimeBetween($firstVisitedAt, 'now'),
            'last_path' => fake()->randomElement(['/', '/layanan', '/paket-harga', '/blog']),
            'last_ip' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
        ];
    }
}
