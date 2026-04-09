<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    public function index(): Response
    {
        $services = Service::query()->ordered()->get();

        return Inertia::render('cms/services/Index', [
            'stats' => [
                'totalServices' => Service::query()->count(),
                'featuredServices' => Service::query()->featured()->count(),
                'activeServices' => Service::query()->active()->count(),
            ],
            'services' => $services->map(fn (Service $service): array => [
                'id' => $service->id,
                'title' => $service->title,
                'slug' => $service->slug,
                'description' => $service->description,
                'iconKey' => $service->icon_key,
                'sortOrder' => $service->sort_order,
                'isFeatured' => $service->is_featured,
                'isActive' => $service->is_active,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/services/Create', [
            'service' => $this->serviceFormData(new Service([
                'icon_key' => 'layout-grid',
                'sort_order' => Service::query()->count() + 1,
                'is_featured' => false,
                'is_active' => true,
            ])),
        ]);
    }

    public function store(StoreServiceRequest $request): RedirectResponse
    {
        Service::query()->create($request->safe()->only([
            'title',
            'slug',
            'description',
            'icon_key',
            'sort_order',
            'is_featured',
            'is_active',
        ]));

        return to_route('cms.services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service): Response
    {
        return Inertia::render('cms/services/Edit', [
            'service' => $this->serviceFormData($service),
        ]);
    }

    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $service->fill($request->safe()->only([
            'title',
            'slug',
            'description',
            'icon_key',
            'sort_order',
            'is_featured',
            'is_active',
        ]))->save();

        return to_route('cms.services.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return to_route('cms.services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function serviceFormData(Service $service): array
    {
        return [
            'id' => $service->id,
            'title' => $service->title ?? '',
            'slug' => $service->slug ?? '',
            'description' => $service->description ?? '',
            'iconKey' => $service->icon_key ?? 'layout-grid',
            'sortOrder' => $service->sort_order ?? 1,
            'isFeatured' => $service->is_featured ?? false,
            'isActive' => $service->is_active ?? true,
        ];
    }
}
