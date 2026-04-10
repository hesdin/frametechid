<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use App\Models\PortfolioItem;
use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Features;

class HomeController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $siteSetting = SiteSetting::current();
        $faqs = FaqItem::query()->published()->ordered()->get();
        $request->attributes->set('seo', $siteSetting->seoData(
            "Jasa Pembuatan Website & Aplikasi Makassar | {$siteSetting->site_name}",
            'Frametech membantu bisnis di Makassar membangun website company profile, landing page, toko online, dan aplikasi web internal yang cepat, rapi, dan siap bersaing di Google.',
            route('home'),
            [
                'jasa pembuatan aplikasi makassar',
                'jasa pembuatan website makassar',
                'web developer makassar',
            ],
            [
                $siteSetting->websiteSchema(),
                $siteSetting->localBusinessSchema(),
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'Service',
                    'name' => 'Jasa Pembuatan Website & Aplikasi Makassar',
                    'provider' => [
                        '@type' => 'LocalBusiness',
                        'name' => $siteSetting->site_name,
                    ],
                    'areaServed' => [
                        '@type' => 'City',
                        'name' => $siteSetting->seo_locality,
                    ],
                    'serviceType' => [
                        'Pembuatan Website',
                        'Pembuatan Aplikasi Web',
                        'SEO Lokal',
                    ],
                ],
                [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $faqs->map(fn (FaqItem $faq): array => [
                        '@type' => 'Question',
                        'name' => $faq->question,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => $faq->answer,
                        ],
                    ])->all(),
                ],
            ],
        ));

        return Inertia::render('Landing', [
            'canRegister' => Features::enabled(Features::registration()),
            'featuredServices' => Service::query()
                ->active()
                ->featured()
                ->ordered()
                ->take(6)
                ->get()
                ->map(fn (Service $service): array => [
                    'title' => $service->title,
                    'description' => $service->description,
                    'iconKey' => $service->icon_key,
                ])->all(),
            'featuredPortfolioItems' => PortfolioItem::query()
                ->published()
                ->featured()
                ->ordered()
                ->take(4)
                ->get()
                ->map(fn (PortfolioItem $item): array => [
                    'title' => $item->title,
                    'summary' => $item->summary,
                    'link' => $item->live_url,
                    'desktopImage' => $item->desktop_image_url,
                    'mobileImage' => $item->mobile_image_url,
                ])->all(),
            'featuredPricingPlans' => PricingPlan::query()
                ->active()
                ->featured()
                ->ordered()
                ->take(3)
                ->get()
                ->map(fn (PricingPlan $plan): array => [
                    'name' => $plan->name,
                    'summary' => $plan->summary,
                    'price' => $plan->price,
                ])->all(),
            'testimonials' => Testimonial::query()
                ->published()
                ->ordered()
                ->take(6)
                ->get()
                ->map(fn (Testimonial $testimonial): array => [
                    'name' => $testimonial->name,
                    'role' => $testimonial->role,
                    'quote' => $testimonial->quote,
                    'avatar' => $testimonial->avatar_url,
                    'rating' => $testimonial->rating,
                ])->all(),
            'faqs' => $faqs->map(fn (FaqItem $faq): array => [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ])->all(),
            'seo' => $request->attributes->get('seo'),
        ]);
    }
}
