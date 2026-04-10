<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTaxonomySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Website Bisnis',
                'slug' => 'website-bisnis',
                'description' => 'Tips membangun website bisnis yang lebih meyakinkan dan efektif menghasilkan lead.',
                'seo_title' => 'Website Bisnis | Blog Frametech',
                'seo_description' => 'Artikel tentang strategi website bisnis, company profile, dan landing page yang membantu konversi.',
            ],
            [
                'name' => 'Aplikasi Web',
                'slug' => 'aplikasi-web',
                'description' => 'Panduan seputar dashboard admin, sistem internal, dan pengembangan aplikasi web custom.',
                'seo_title' => 'Aplikasi Web | Blog Frametech',
                'seo_description' => 'Insight pengembangan aplikasi web custom untuk operasional bisnis dan efisiensi kerja.',
            ],
            [
                'name' => 'SEO Lokal Makassar',
                'slug' => 'seo-lokal-makassar',
                'description' => 'Konten SEO untuk bisnis Makassar yang ingin lebih mudah ditemukan di Google.',
                'seo_title' => 'SEO Lokal Makassar | Blog Frametech',
                'seo_description' => 'Panduan optimasi SEO lokal untuk website bisnis dan jasa di Makassar.',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::query()->updateOrCreate(
                ['slug' => $category['slug']],
                $category,
            );
        }

        $tags = [
            ['name' => 'Company Profile', 'slug' => 'company-profile'],
            ['name' => 'Landing Page', 'slug' => 'landing-page'],
            ['name' => 'SEO', 'slug' => 'seo'],
            ['name' => 'Makassar', 'slug' => 'makassar'],
            ['name' => 'Aplikasi Bisnis', 'slug' => 'aplikasi-bisnis'],
            ['name' => 'UI UX', 'slug' => 'ui-ux'],
        ];

        foreach ($tags as $tag) {
            BlogTag::query()->updateOrCreate(
                ['slug' => $tag['slug']],
                $tag,
            );
        }
    }
}
