<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use App\Models\Lead;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the application dashboard.
     */
    public function __invoke(): Response
    {
        $posts = Post::query()
            ->latest('updated_at')
            ->with('author:id,name')
            ->take(5)
            ->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalPosts' => Post::query()->count(),
                'publishedPosts' => Post::query()->published()->count(),
                'draftPosts' => Post::query()->where('status', 'draft')->count(),
            ],
            'contentStats' => [
                'services' => Service::query()->count(),
                'pricingPlans' => PricingPlan::query()->count(),
                'portfolioItems' => PortfolioItem::query()->count(),
                'testimonials' => Testimonial::query()->count(),
                'faqs' => FaqItem::query()->count(),
                'newLeads' => Lead::query()->where('status', Lead::STATUS_NEW)->count(),
            ],
            'recentPosts' => $posts->map(fn (Post $post): array => [
                'id' => $post->id,
                'title' => $post->title,
                'status' => $post->status,
                'author' => $post->author?->name ?? 'Tim '.SiteSetting::current()->site_name,
                'updatedAt' => $post->updated_at->diffForHumans(),
            ])->all(),
        ]);
    }
}
