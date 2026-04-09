<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Paket Start',
                'slug' => 'paket-start',
                'summary' => 'Paket ringkas untuk bisnis yang baru mulai online dan butuh website cepat tayang dengan struktur yang jelas.',
                'previous_price' => 'Rp3.000.000',
                'price' => 'Rp1.500.000',
                'discount_label' => 'Diskon 50%',
                'note' => 'Cocok untuk UMKM yang ingin tampil profesional dengan budget efisien.',
                'cta_label' => 'Mulai Sekarang',
                'features' => [
                    '3 halaman utama website',
                    'Gratis domain dan hosting tahun pertama',
                    'Desain mengikuti brand bisnis',
                    'Integrasi WhatsApp dan formulir kontak',
                    'Setup SEO dasar untuk pencarian lokal',
                ],
                'icon_letter' => 'S',
                'accent_tone' => 'bronze',
                'sort_order' => 1,
                'is_featured' => false,
            ],
            [
                'name' => 'Paket Growth',
                'slug' => 'paket-growth',
                'summary' => 'Untuk bisnis yang butuh struktur lebih lengkap, konten layanan lebih banyak, dan tampilan lebih kuat untuk closing.',
                'previous_price' => 'Rp6.500.000',
                'price' => 'Rp4.500.000',
                'discount_label' => 'Diskon 31%',
                'note' => 'Paket paling seimbang untuk brand yang sedang aktif promosi.',
                'cta_label' => 'Pilih Paket Ini',
                'features' => [
                    'Company profile lengkap',
                    'Halaman layanan, galeri, dan FAQ',
                    'SEO lokal Makassar dan Google Maps link',
                    'Konsultasi struktur konten dan CTA',
                    'Support revisi minor setelah launching',
                ],
                'icon_letter' => 'G',
                'accent_tone' => 'silver',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Signature',
                'slug' => 'paket-signature',
                'summary' => 'Paket premium untuk website bisnis besar, sistem katalog kompleks, atau kebutuhan aplikasi web yang lebih custom.',
                'previous_price' => 'Rp11.000.000',
                'price' => 'Rp8.500.000',
                'discount_label' => 'Diskon 23%',
                'note' => 'Ideal untuk perusahaan yang ingin tampil lebih eksklusif dan fleksibel.',
                'cta_label' => 'Konsultasi Premium',
                'features' => [
                    'Semua fitur paket Growth',
                    'Custom section dan alur halaman',
                    'Prioritas untuk kebutuhan aplikasi web',
                    'Pendampingan SEO on-page lebih lengkap',
                    'Support pasca-launching hingga 3 bulan',
                ],
                'icon_letter' => 'P',
                'accent_tone' => 'gold',
                'sort_order' => 3,
                'is_featured' => true,
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::query()->updateOrCreate(
                ['slug' => $plan['slug']],
                [...$plan, 'is_active' => true],
            );
        }
    }
}
