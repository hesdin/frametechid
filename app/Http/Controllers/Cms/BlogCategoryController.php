<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class BlogCategoryController extends Controller
{
    public function index(): Response
    {
        $categories = BlogCategory::query()->withCount('posts')->orderBy('name')->get();

        return Inertia::render('cms/blog-categories/Index', [
            'stats' => [
                'totalCategories' => $categories->count(),
                'usedCategories' => $categories->where('posts_count', '>', 0)->count(),
            ],
            'categories' => $categories->map(fn (BlogCategory $category): array => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'postsCount' => $category->posts_count,
                'seoTitle' => $category->seo_title,
                'seoDescription' => $category->seo_description,
            ])->all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('cms/blog-categories/Create', [
            'category' => $this->formData(new BlogCategory),
        ]);
    }

    public function store(StoreBlogCategoryRequest $request): RedirectResponse
    {
        BlogCategory::query()->create($request->validated());

        return to_route('cms.blog-categories.index')
            ->with('success', 'Kategori blog berhasil ditambahkan.');
    }

    public function edit(BlogCategory $blogCategory): Response
    {
        return Inertia::render('cms/blog-categories/Edit', [
            'category' => $this->formData($blogCategory),
        ]);
    }

    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->fill($request->validated())->save();

        return to_route('cms.blog-categories.index')
            ->with('success', 'Kategori blog berhasil diperbarui.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return to_route('cms.blog-categories.index')
            ->with('success', 'Kategori blog berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function formData(BlogCategory $blogCategory): array
    {
        return [
            'id' => $blogCategory->id,
            'name' => $blogCategory->name ?? '',
            'slug' => $blogCategory->slug ?? '',
            'description' => $blogCategory->description ?? '',
            'seoTitle' => $blogCategory->seo_title ?? '',
            'seoDescription' => $blogCategory->seo_description ?? '',
        ];
    }
}
