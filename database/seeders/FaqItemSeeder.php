<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use Illuminate\Database\Seeder;

class FaqItemSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama proses pembuatan website atau aplikasi?',
                'answer' => 'Rata-rata 5 sampai 14 hari kerja setelah kebutuhan dan konten utama disepakati. Untuk sistem yang lebih kompleks, estimasi akan dijelaskan sejak awal agar timeline tetap realistis.',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah bisa dibantu isi konten website juga?',
                'answer' => 'Bisa. Kami dapat membantu menyusun struktur copywriting dasar untuk hero, layanan, CTA, dan halaman penting lain agar website lebih siap dipakai promosi.',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah website sudah mobile responsive?',
                'answer' => 'Ya. Semua website dan dashboard dibuat responsif supaya nyaman digunakan dari HP, tablet, maupun desktop.',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah bisa integrasi WhatsApp, Google Maps, atau form kontak?',
                'answer' => 'Bisa. Integrasi WhatsApp, Google Maps, form lead, dan kebutuhan dasar marketing lain bisa dimasukkan sesuai kebutuhan proyek.',
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            FaqItem::query()->updateOrCreate(
                ['question' => $faq['question']],
                $faq,
            );
        }
    }
}
