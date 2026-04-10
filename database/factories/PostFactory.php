<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = Str::headline(fake()->unique()->words(fake()->numberBetween(4, 8), true));

        return [
            'author_id' => User::factory(),
            'category_id' => BlogCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->realText(180),
            'content' => implode("\n\n", fake()->paragraphs(6)),
            'cover_image' => sprintf(
                'https://images.unsplash.com/photo-%s?auto=format&fit=crop&w=1600&q=80',
                fake()->randomElement([
                    '1497366754035-f200968a6e72',
                    '1552664730-d307ca884978',
                    '1556740749-887f6717d7e4',
                    '1516321318423-f06f85e504b3',
                ]),
            ),
            'status' => 'draft',
            'seo_title' => "{$title} | Blog Frametech",
            'seo_description' => fake()->text(155),
            'seo_keywords' => implode(', ', fake()->words(4)),
            'published_at' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (): array => [
            'status' => 'published',
            'published_at' => now()->subDays(fake()->numberBetween(1, 30)),
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post): void {
            $tags = BlogTag::query()->inRandomOrder()->limit(fake()->numberBetween(1, 3))->pluck('id');

            if ($tags->isNotEmpty()) {
                $post->tags()->syncWithoutDetaching($tags->all());
            }
        });
    }
}
