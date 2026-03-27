<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::inertia('/', 'Landing', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');
Route::inertia('/layanan', 'Services')->name('services');
Route::inertia('/paket-harga', 'Pricing')->name('pricing');
Route::inertia('/portofolio', 'PortfolioIndex')->name('portfolio');
Route::inertia('/tentang-kami', 'About')->name('about');
Route::inertia('/blog', 'Blog')->name('blog');
Route::get('/blog/{slug}', function (string $slug) {
    return Inertia::render('BlogShow', [
        'slug' => $slug,
    ]);
})->name('blog.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
