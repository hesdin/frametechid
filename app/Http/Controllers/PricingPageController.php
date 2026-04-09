<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PricingPageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $siteSetting = SiteSetting::current();
        $request->attributes->set('seo', $siteSetting->seoData(
            "Harga Jasa Pembuatan Website & Aplikasi Makassar | {$siteSetting->site_name}",
            'Pilih paket jasa pembuatan website dan aplikasi yang sesuai untuk bisnis di Makassar. Ada pilihan mulai dari website UMKM hingga kebutuhan aplikasi web custom.',
            route('pricing'),
            [
                'harga jasa pembuatan website makassar',
                'biaya pembuatan aplikasi makassar',
                'paket website bisnis makassar',
            ],
            [$siteSetting->localBusinessSchema()],
        ));

        return Inertia::render('Pricing', [
            'plans' => PricingPlan::query()
                ->active()
                ->ordered()
                ->get()
                ->map(fn (PricingPlan $plan): array => [
                    'name' => $plan->name,
                    'summary' => $plan->summary,
                    'previousPrice' => $plan->previous_price,
                    'price' => $plan->price,
                    'discount' => $plan->discount_label,
                    'note' => $plan->note,
                    'cta' => $plan->cta_label,
                    'features' => $plan->features ?? [],
                    'iconLetter' => $plan->icon_letter,
                    'accentTone' => $plan->accent_tone,
                ])->all(),
            'seo' => $request->attributes->get('seo'),
        ]);
    }
}
