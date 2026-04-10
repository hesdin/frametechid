<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = (string) config('seeding.admin.email');
        $adminName = (string) config('seeding.admin.name');
        $adminPassword = (string) config('seeding.admin.password');

        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            SiteSetting::defaults(),
        );

        User::query()->updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'email' => $adminEmail,
                'email_verified_at' => now(),
                'password' => Hash::make($adminPassword),
            ],
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
