<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TestimonialController extends Controller
{
    public function index(): Response
    {
        $testimonials = Testimonial::query()->ordered()->get();

        return Inertia::render('cms/testimonials/Index', [
            'stats' => [
                'totalTestimonials' => $testimonials->count(),
                'publishedTestimonials' => $testimonials->where('is_published', true)->count(),
                'averageRating' => round((float) ($testimonials->avg('rating') ?? 0), 1),
            ],
            'testimonials' => $testimonials->map(fn (Testimonial $testimonial): array => [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'role' => $testimonial->role,
                'quote' => $testimonial->quote,
                'avatarUrl' => $testimonial->avatar_url,
                'rating' => $testimonial->rating,
                'sortOrder' => $testimonial->sort_order,
                'isPublished' => $testimonial->is_published,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/testimonials/Create', [
            'testimonial' => $this->formData(new Testimonial([
                'rating' => 5,
                'sort_order' => Testimonial::query()->count() + 1,
                'is_published' => true,
            ])),
        ]);
    }

    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        Testimonial::query()->create($request->validated());

        return to_route('cms.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial): Response
    {
        return Inertia::render('cms/testimonials/Edit', [
            'testimonial' => $this->formData($testimonial),
        ]);
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $testimonial->fill($request->validated())->save();

        return to_route('cms.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return to_route('cms.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function formData(Testimonial $testimonial): array
    {
        return [
            'id' => $testimonial->id,
            'name' => $testimonial->name ?? '',
            'role' => $testimonial->role ?? '',
            'quote' => $testimonial->quote ?? '',
            'avatarUrl' => $testimonial->avatar_url ?? '',
            'rating' => $testimonial->rating ?? 5,
            'sortOrder' => $testimonial->sort_order ?? 1,
            'isPublished' => $testimonial->is_published ?? true,
        ];
    }
}
