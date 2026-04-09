<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ServicePageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $siteSetting = SiteSetting::current();
        $request->attributes->set('seo', $siteSetting->seoData(
            "Layanan Pembuatan Website & Aplikasi di {$siteSetting->seo_locality} | {$siteSetting->site_name}",
            'Lihat layanan utama Frametech untuk bisnis di Makassar: company profile, landing page, toko online, hingga aplikasi web custom untuk operasional bisnis.',
            route('services'),
            [
                'layanan pembuatan website makassar',
                'jasa pembuatan aplikasi makassar',
                'company profile makassar',
            ],
            [$siteSetting->localBusinessSchema()],
        ));

        return Inertia::render('Services', [
            'services' => Service::query()
                ->active()
                ->ordered()
                ->get()
                ->map(fn (Service $service): array => [
                    'title' => $service->title,
                    'slug' => $service->slug,
                    'description' => $service->description,
                    'iconKey' => $service->icon_key,
                ])->all(),
            'pricingPlans' => PricingPlan::query()
                ->active()
                ->ordered()
                ->take(3)
                ->get()
                ->map(fn (PricingPlan $plan): array => [
                    'name' => $plan->name,
                    'summary' => $plan->summary,
                    'accentTone' => $plan->accent_tone,
                    'iconLetter' => $plan->icon_letter,
                ])->all(),
            'seo' => $request->attributes->get('seo'),
        ]);
    }
}
