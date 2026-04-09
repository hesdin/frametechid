<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePricingPlanRequest;
use App\Http\Requests\UpdatePricingPlanRequest;
use App\Models\PricingPlan;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PricingPlanController extends Controller
{
    public function index(): Response
    {
        $plans = PricingPlan::query()->ordered()->get();

        return Inertia::render('cms/pricing/Index', [
            'stats' => [
                'totalPlans' => PricingPlan::query()->count(),
                'featuredPlans' => PricingPlan::query()->featured()->count(),
                'activePlans' => PricingPlan::query()->active()->count(),
            ],
            'plans' => $plans->map(fn (PricingPlan $plan): array => [
                'id' => $plan->id,
                'name' => $plan->name,
                'slug' => $plan->slug,
                'summary' => $plan->summary,
                'price' => $plan->price,
                'discountLabel' => $plan->discount_label,
                'featuresCount' => count($plan->features ?? []),
                'accentTone' => $plan->accent_tone,
                'sortOrder' => $plan->sort_order,
                'isFeatured' => $plan->is_featured,
                'isActive' => $plan->is_active,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/pricing/Create', [
            'plan' => $this->pricingPlanFormData(new PricingPlan([
                'accent_tone' => 'bronze',
                'icon_letter' => 'A',
                'sort_order' => PricingPlan::query()->count() + 1,
                'cta_label' => 'Pilih Paket',
                'is_featured' => false,
                'is_active' => true,
            ])),
        ]);
    }

    public function store(StorePricingPlanRequest $request): RedirectResponse
    {
        PricingPlan::query()->create($request->safe()->only([
            'name',
            'slug',
            'summary',
            'previous_price',
            'price',
            'discount_label',
            'note',
            'cta_label',
            'features',
            'icon_letter',
            'accent_tone',
            'sort_order',
            'is_featured',
            'is_active',
        ]));

        return to_route('cms.pricing.index')
            ->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function edit(PricingPlan $pricingPlan): Response
    {
        return Inertia::render('cms/pricing/Edit', [
            'plan' => $this->pricingPlanFormData($pricingPlan),
        ]);
    }

    public function update(
        UpdatePricingPlanRequest $request,
        PricingPlan $pricingPlan,
    ): RedirectResponse {
        $pricingPlan->fill($request->safe()->only([
            'name',
            'slug',
            'summary',
            'previous_price',
            'price',
            'discount_label',
            'note',
            'cta_label',
            'features',
            'icon_letter',
            'accent_tone',
            'sort_order',
            'is_featured',
            'is_active',
        ]))->save();

        return to_route('cms.pricing.index')
            ->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function destroy(PricingPlan $pricingPlan): RedirectResponse
    {
        $pricingPlan->delete();

        return to_route('cms.pricing.index')
            ->with('success', 'Paket harga berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function pricingPlanFormData(PricingPlan $pricingPlan): array
    {
        return [
            'id' => $pricingPlan->id,
            'name' => $pricingPlan->name ?? '',
            'slug' => $pricingPlan->slug ?? '',
            'summary' => $pricingPlan->summary ?? '',
            'previousPrice' => $pricingPlan->previous_price ?? '',
            'price' => $pricingPlan->price ?? '',
            'discountLabel' => $pricingPlan->discount_label ?? '',
            'note' => $pricingPlan->note ?? '',
            'ctaLabel' => $pricingPlan->cta_label ?? 'Pilih Paket',
            'featuresText' => implode(PHP_EOL, $pricingPlan->features ?? []),
            'iconLetter' => $pricingPlan->icon_letter ?? 'A',
            'accentTone' => $pricingPlan->accent_tone ?? 'bronze',
            'sortOrder' => $pricingPlan->sort_order ?? 1,
            'isFeatured' => $pricingPlan->is_featured ?? false,
            'isActive' => $pricingPlan->is_active ?? true,
        ];
    }
}
