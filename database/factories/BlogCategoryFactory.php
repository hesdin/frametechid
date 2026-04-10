<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::headline(fake()->unique()->words(fake()->numberBetween(2, 4), true));

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(fake()->numberBetween(12, 18)),
            'seo_title' => "{$name} | Blog Frametech",
            'seo_description' => fake()->text(150),
        ];
    }
}
