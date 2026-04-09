<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioItemRequest;
use App\Http\Requests\UpdatePortfolioItemRequest;
use App\Models\PortfolioItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PortfolioItemController extends Controller
{
    public function index(): Response
    {
        $items = PortfolioItem::query()->ordered()->get();

        return Inertia::render('cms/portfolio/Index', [
            'stats' => [
                'totalItems' => PortfolioItem::query()->count(),
                'featuredItems' => PortfolioItem::query()->featured()->count(),
                'publishedItems' => PortfolioItem::query()->published()->count(),
            ],
            'items' => $items->map(fn (PortfolioItem $item): array => [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
                'industry' => $item->industry,
                'location' => $item->location,
                'liveUrl' => $item->live_url,
                'sortOrder' => $item->sort_order,
                'isFeatured' => $item->is_featured,
                'isPublished' => $item->is_published,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/portfolio/Create', [
            'item' => $this->portfolioItemFormData(new PortfolioItem([
                'sort_order' => PortfolioItem::query()->count() + 1,
                'is_featured' => false,
                'is_published' => true,
            ])),
        ]);
    }

    public function store(StorePortfolioItemRequest $request): RedirectResponse
    {
        PortfolioItem::query()->create($request->safe()->only([
            'title',
            'slug',
            'client_name',
            'industry',
            'location',
            'summary',
            'live_url',
            'desktop_image_url',
            'mobile_image_url',
            'sort_order',
            'is_featured',
            'is_published',
        ]));

        return to_route('cms.portfolio.index')
            ->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(PortfolioItem $portfolioItem): Response
    {
        return Inertia::render('cms/portfolio/Edit', [
            'item' => $this->portfolioItemFormData($portfolioItem),
        ]);
    }

    public function update(
        UpdatePortfolioItemRequest $request,
        PortfolioItem $portfolioItem,
    ): RedirectResponse {
        $portfolioItem->fill($request->safe()->only([
            'title',
            'slug',
            'client_name',
            'industry',
            'location',
            'summary',
            'live_url',
            'desktop_image_url',
            'mobile_image_url',
            'sort_order',
            'is_featured',
            'is_published',
        ]))->save();

        return to_route('cms.portfolio.index')
            ->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $portfolioItem->delete();

        return to_route('cms.portfolio.index')
            ->with('success', 'Portofolio berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function portfolioItemFormData(PortfolioItem $portfolioItem): array
    {
        return [
            'id' => $portfolioItem->id,
            'title' => $portfolioItem->title ?? '',
            'slug' => $portfolioItem->slug ?? '',
            'clientName' => $portfolioItem->client_name ?? '',
            'industry' => $portfolioItem->industry ?? '',
            'location' => $portfolioItem->location ?? '',
            'summary' => $portfolioItem->summary ?? '',
            'liveUrl' => $portfolioItem->live_url ?? '',
            'desktopImageUrl' => $portfolioItem->desktop_image_url ?? '',
            'mobileImageUrl' => $portfolioItem->mobile_image_url ?? '',
            'sortOrder' => $portfolioItem->sort_order ?? 1,
            'isFeatured' => $portfolioItem->is_featured ?? false,
            'isPublished' => $portfolioItem->is_published ?? true,
        ];
    }
}
