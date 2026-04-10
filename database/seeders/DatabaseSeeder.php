<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            SiteSetting::defaults(),
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->make([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ])->toArray(),
        );

        $this->call([
            ServiceSeeder::class,
            PricingPlanSeeder::class,
            PortfolioItemSeeder::class,
            TestimonialSeeder::class,
            FaqItemSeeder::class,
            BlogTaxonomySeeder::class,
            PostSeeder::class,
        ]);
    }
}
