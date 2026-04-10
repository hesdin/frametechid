<?php

use App\Models\Post;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;

test('database seeder creates deterministic admin and blog content', function (): void {
    config()->set('seeding.admin.name', 'Production Admin');
    config()->set('seeding.admin.email', 'admin@frametech.id');
    config()->set('seeding.admin.password', 'super-secret-password');

    $this->seed(DatabaseSeeder::class);

    $admin = User::query()->where('email', 'admin@frametech.id')->first();

    expect($admin)->not->toBeNull();
    expect($admin?->name)->toBe('Production Admin');
    expect($admin?->email_verified_at)->not->toBeNull();
    expect($admin?->password)->not->toBe('super-secret-password');
    expect(Post::query()->count())->toBe(5);
    expect(
        Post::query()->where('slug', 'pembuatan-website-umkm-cara-bisnis-lokal-scale-up-dan-perluas-market-di-2026')->exists()
    )->toBeTrue();
});
