<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioPageController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $siteSetting = SiteSetting::current();
        $request->attributes->set('seo', $siteSetting->seoData(
            "Portofolio Website & Aplikasi Bisnis Makassar | {$siteSetting->site_name}",
            'Lihat contoh website dan aplikasi web yang telah dikerjakan Frametech untuk bisnis kuliner, kesehatan, pendidikan, hospitality, dan perusahaan profesional di Makassar.',
            route('portfolio'),
            [
                'portofolio website makassar',
                'contoh aplikasi web bisnis makassar',
                'jasa website makassar portofolio',
            ],
            [$siteSetting->localBusinessSchema()],
        ));

        return Inertia::render('PortfolioIndex', [
            'items' => PortfolioItem::query()
                ->published()
                ->ordered()
                ->get()
                ->map(fn (PortfolioItem $item): array => [
                    'title' => $item->title,
                    'clientName' => $item->client_name,
                    'industry' => $item->industry,
                    'location' => $item->location,
                    'summary' => $item->summary,
                    'liveUrl' => $item->live_url,
                    'desktopImage' => $item->desktop_image_url,
                    'mobileImage' => $item->mobile_image_url,
                ])->all(),
            'seo' => $request->attributes->get('seo'),
        ]);
    }
}
