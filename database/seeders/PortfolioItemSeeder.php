<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'Serata Engineering',
                'slug' => 'serata-engineering',
                'client_name' => 'Serata Engineering',
                'industry' => 'Teknik & Industri',
                'location' => 'Makassar',
                'summary' => 'Company profile website untuk perusahaan teknik dengan fokus pada layanan inti, proyek, dan kontak yang lebih kredibel.',
                'live_url' => 'https://example.com/serata-engineering',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1598128558393-70ff21433be0?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Coral Cafe',
                'slug' => 'coral-cafe',
                'client_name' => 'Coral Cafe',
                'industry' => 'Kuliner',
                'location' => 'Makassar',
                'summary' => 'Landing page cafe dengan tampilan visual kuat, galeri menu, dan CTA reservasi yang lebih mudah diakses pengunjung.',
                'live_url' => 'https://example.com/coral-cafe',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Harmoni Clinic',
                'slug' => 'harmoni-clinic',
                'client_name' => 'Harmoni Clinic',
                'industry' => 'Kesehatan',
                'location' => 'Makassar',
                'summary' => 'Website klinik dengan struktur layanan, profil dokter, dan kontak yang disusun agar pasien lebih percaya.',
                'live_url' => 'https://example.com/harmoni-clinic',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'Sekolah Harapan',
                'slug' => 'sekolah-harapan',
                'client_name' => 'Sekolah Harapan',
                'industry' => 'Pendidikan',
                'location' => 'Makassar',
                'summary' => 'Website sekolah untuk menampilkan program, agenda, dan pendaftaran dengan navigasi yang lebih jelas untuk orang tua.',
                'live_url' => 'https://example.com/sekolah-harapan',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'title' => 'Makassar Booking Suite',
                'slug' => 'makassar-booking-suite',
                'client_name' => 'Makassar Booking Suite',
                'industry' => 'Aplikasi Web',
                'location' => 'Makassar',
                'summary' => 'Contoh aplikasi web booking dan dashboard admin untuk mengelola reservasi, data pelanggan, dan laporan operasional.',
                'live_url' => 'https://example.com/makassar-booking-suite',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 5,
                'is_featured' => true,
            ],
            [
                'title' => 'Sky Resort',
                'slug' => 'sky-resort',
                'client_name' => 'Sky Resort',
                'industry' => 'Hospitality',
                'location' => 'Maros',
                'summary' => 'Website resort dengan galeri visual, detail fasilitas, dan CTA reservasi untuk pengalaman brand yang lebih premium.',
                'live_url' => 'https://example.com/sky-resort',
                'desktop_image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1800&q=80',
                'mobile_image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80',
                'sort_order' => 6,
                'is_featured' => false,
            ],
        ];

        foreach ($items as $item) {
            PortfolioItem::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [...$item, 'is_published' => true],
            );
        }
    }
}
