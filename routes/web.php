<?php

use App\Http\Controllers\Cms\PortfolioItemController as CmsPortfolioItemController;
use App\Http\Controllers\Cms\PostController as CmsPostController;
use App\Http\Controllers\Cms\PricingPlanController as CmsPricingPlanController;
use App\Http\Controllers\Cms\ServiceController as CmsServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PricingPageController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\SiteAssetController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/layanan', ServicePageController::class)->name('services');
Route::get('/paket-harga', PricingPageController::class)->name('pricing');
Route::get('/portofolio', PortfolioPageController::class)->name('portfolio');
Route::inertia('/tentang-kami', 'About')->name('about');
Route::get('/blog', [PostController::class, 'index'])->name('blog');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');
Route::get('/site-assets/{asset}', SiteAssetController::class)
    ->whereIn('asset', ['logo', 'favicon'])
    ->name('site-assets.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('dashboard/blog', CmsPostController::class)
        ->except('show')
        ->parameters(['blog' => 'post'])
        ->names('cms.blog');
    Route::resource('dashboard/services', CmsServiceController::class)
        ->except('show')
        ->names('cms.services');
    Route::resource('dashboard/pricing-plans', CmsPricingPlanController::class)
        ->except('show')
        ->parameters(['pricing-plans' => 'pricing_plan'])
        ->names('cms.pricing');
    Route::resource('dashboard/portfolio', CmsPortfolioItemController::class)
        ->except('show')
        ->parameters(['portfolio' => 'portfolio_item'])
        ->names('cms.portfolio');
});

require __DIR__.'/settings.php';
