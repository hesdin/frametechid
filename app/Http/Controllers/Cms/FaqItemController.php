<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqItemRequest;
use App\Http\Requests\UpdateFaqItemRequest;
use App\Models\FaqItem;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FaqItemController extends Controller
{
    public function index(): Response
    {
        $faqItems = FaqItem::query()->ordered()->get();

        return Inertia::render('cms/faqs/Index', [
            'stats' => [
                'totalFaqs' => $faqItems->count(),
                'publishedFaqs' => $faqItems->where('is_published', true)->count(),
            ],
            'faqItems' => $faqItems->map(fn (FaqItem $faqItem): array => [
                'id' => $faqItem->id,
                'question' => $faqItem->question,
                'answer' => $faqItem->answer,
                'sortOrder' => $faqItem->sort_order,
                'isPublished' => $faqItem->is_published,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/faqs/Create', [
            'faqItem' => $this->formData(new FaqItem([
                'sort_order' => FaqItem::query()->count() + 1,
                'is_published' => true,
            ])),
        ]);
    }

    public function store(StoreFaqItemRequest $request): RedirectResponse
    {
        FaqItem::query()->create($request->validated());

        return to_route('cms.faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(FaqItem $faqItem): Response
    {
        return Inertia::render('cms/faqs/Edit', [
            'faqItem' => $this->formData($faqItem),
        ]);
    }

    public function update(UpdateFaqItemRequest $request, FaqItem $faqItem): RedirectResponse
    {
        $faqItem->fill($request->validated())->save();

        return to_route('cms.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(FaqItem $faqItem): RedirectResponse
    {
        $faqItem->delete();

        return to_route('cms.faqs.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function formData(FaqItem $faqItem): array
    {
        return [
            'id' => $faqItem->id,
            'question' => $faqItem->question ?? '',
            'answer' => $faqItem->answer ?? '',
            'sortOrder' => $faqItem->sort_order ?? 1,
            'isPublished' => $faqItem->is_published ?? true,
        ];
    }
}
