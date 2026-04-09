<?php

namespace Database\Seeders;

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

        Post::factory()
            ->count(3)
            ->for($author, 'author')
            ->published()
            ->create();

        Post::factory()
            ->count(2)
            ->for($author, 'author')
            ->create();
    }
}
