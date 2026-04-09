<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Jasa Pembuatan Website UMKM',
                'slug' => 'jasa-pembuatan-website-umkm',
                'description' => 'Website profesional untuk usaha lokal di Makassar agar bisnis lebih dipercaya, mudah ditemukan, dan siap menerima lebih banyak calon pelanggan.',
                'icon_key' => 'store',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Company Profile Website',
                'slug' => 'company-profile-website',
                'description' => 'Cocok untuk kontraktor, supplier, jasa profesional, dan perusahaan yang butuh profil bisnis rapi dengan presentasi layanan yang kuat.',
                'icon_key' => 'building-2',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Landing Page Promosi',
                'slug' => 'landing-page-promosi',
                'description' => 'Halaman promosi dengan CTA jelas untuk kampanye iklan, launching produk, dan jasa yang fokus pada lead masuk dari WhatsApp.',
                'icon_key' => 'megaphone',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'Jasa Pembuatan Aplikasi Web',
                'slug' => 'jasa-pembuatan-aplikasi-web',
                'description' => 'Pengembangan aplikasi web dan sistem internal untuk operasional bisnis, dashboard admin, booking, katalog, atau workflow custom.',
                'icon_key' => 'monitor-smartphone',
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'title' => 'Website E-Commerce',
                'slug' => 'website-e-commerce',
                'description' => 'Toko online dengan katalog produk, alur order yang lebih jelas, dan fondasi SEO untuk menarik pencarian produk maupun brand.',
                'icon_key' => 'shopping-cart',
                'sort_order' => 5,
                'is_featured' => true,
            ],
            [
                'title' => 'Website Portofolio & Agency',
                'slug' => 'website-portofolio-agency',
                'description' => 'Menampilkan hasil kerja, studi kasus, dan layanan secara lebih premium untuk freelancer, studio kreatif, dan agensi.',
                'icon_key' => 'briefcase-business',
                'sort_order' => 6,
                'is_featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(
                ['slug' => $service['slug']],
                [...$service, 'is_active' => true],
            );
        }
    }
}
