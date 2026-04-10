<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::query()->first() ?? User::factory()->create([
            'name' => 'Frametech Admin',
            'email' => 'admin@frametech.test',
        ]);

        $categories = BlogCategory::query()->get();
        $tags = BlogTag::query()->get();

        Post::factory()
            ->count(3)
            ->for($author, 'author')
            ->published()
            ->create()
            ->each(function (Post $post) use ($categories, $tags): void {
                $post->update([
                    'category_id' => $categories->random()?->id,
                ]);

                $post->tags()->sync($tags->random(rand(1, min(3, $tags->count())))->pluck('id')->all());
            });

        Post::factory()
            ->count(2)
            ->for($author, 'author')
            ->create()
            ->each(function (Post $post) use ($categories, $tags): void {
                $post->update([
                    'category_id' => $categories->random()?->id,
                ]);

                $post->tags()->sync($tags->random(rand(1, min(2, $tags->count())))->pluck('id')->all());
            });
    }
}
