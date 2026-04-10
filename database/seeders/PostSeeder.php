<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::query()->firstOrCreate(
            ['email' => (string) config('seeding.admin.email')],
            [
                'name' => (string) config('seeding.admin.name'),
                'email_verified_at' => now(),
                'password' => bcrypt((string) config('seeding.admin.password')),
            ],
        );

        $posts = [
            [
                'title' => 'Pembuatan Website UMKM: Cara Bisnis Lokal Scale Up dan Perluas Market di 2026',
                'slug' => 'pembuatan-website-umkm-cara-bisnis-lokal-scale-up-dan-perluas-market-di-2026',
                'excerpt' => 'Website UMKM yang rapi membantu bisnis lokal terlihat lebih dipercaya, mudah ditemukan, dan lebih siap menerima calon pelanggan baru.',
                'content' => implode("\n\n", [
                    'Banyak UMKM sudah aktif di WhatsApp dan Instagram, tetapi belum punya aset digital yang benar-benar mereka miliki. Website memberi pusat informasi yang stabil untuk profil usaha, layanan, katalog, dan CTA yang lebih jelas.',
                    'Di 2026, perilaku calon pelanggan makin kuat ke pencarian lokal. Saat orang mencari jasa atau produk, website yang ringan, jelas, dan mobile-friendly akan jauh lebih meyakinkan dibanding hanya akun media sosial.',
                    'Website UMKM yang efektif tidak perlu rumit. Fokus utama biasanya ada pada profil usaha, penjelasan layanan, bukti sosial, portofolio, FAQ, dan tombol WhatsApp yang mudah dijangkau.',
                ]),
                'category' => 'website-bisnis',
                'tags' => ['company-profile', 'makassar'],
                'status' => 'published',
                'published_at' => Carbon::parse('2026-01-12 09:00:00'),
                'seo_title' => 'Pembuatan Website UMKM untuk Bisnis Lokal di 2026 | Frametech',
                'seo_description' => 'Panduan membangun website UMKM yang lebih meyakinkan, mudah ditemukan, dan siap membantu bisnis lokal scale up di 2026.',
                'seo_keywords' => 'website umkm, website bisnis lokal, jasa website makassar',
            ],
            [
                'title' => 'Landing Page Promosi yang Fokus pada Lead Masuk, Bukan Sekadar Ramai Dikunjungi',
                'slug' => 'landing-page-promosi-fokus-pada-lead-masuk',
                'excerpt' => 'Landing page yang baik menyederhanakan pesan, memperjelas penawaran, dan mendorong pengunjung mengambil aksi tanpa banyak distraksi.',
                'content' => implode("\n\n", [
                    'Masalah umum landing page adalah terlalu banyak informasi dan terlalu sedikit arahan. Pengunjung akhirnya paham isi halaman, tetapi tidak terdorong untuk menghubungi atau memesan.',
                    'Struktur landing page sebaiknya sederhana: headline yang kuat, manfaat utama, bukti sosial, penjelasan singkat proses, lalu CTA yang konsisten di beberapa titik penting.',
                    'Untuk campaign iklan, kecepatan halaman dan relevansi pesan jauh lebih penting daripada animasi berlebihan. Fokus utama tetap pada konversi.',
                ]),
                'category' => 'website-bisnis',
                'tags' => ['landing-page', 'seo'],
                'status' => 'published',
                'published_at' => Carbon::parse('2026-02-03 10:30:00'),
                'seo_title' => 'Landing Page Promosi untuk Lead yang Lebih Masuk | Frametech',
                'seo_description' => 'Pelajari struktur landing page promosi yang lebih fokus pada konversi dan lead masuk untuk campaign digital.',
                'seo_keywords' => 'landing page promosi, landing page lead, jasa landing page',
            ],
            [
                'title' => 'Kapan Bisnis Perlu Company Profile Website dan Bukan Hanya Instagram',
                'slug' => 'kapan-bisnis-perlu-company-profile-website',
                'excerpt' => 'Saat bisnis mulai sering kirim proposal, penawaran, atau presentasi layanan, company profile website biasanya jadi kebutuhan dasar.',
                'content' => implode("\n\n", [
                    'Instagram bagus untuk awareness, tetapi tidak selalu ideal untuk menjelaskan layanan yang kompleks. Company profile website memberi ruang untuk menyusun value proposition, portfolio, dan profil bisnis secara lebih rapi.',
                    'Website juga memudahkan calon klien mengecek kredibilitas bisnis sebelum menghubungi. Ini penting untuk sektor jasa profesional, kontraktor, supplier, dan B2B.',
                    'Jika bisnis Anda sering diminta mengirim company profile PDF, kemungkinan besar website akan menjadi aset yang lebih efisien dalam jangka panjang.',
                ]),
                'category' => 'website-bisnis',
                'tags' => ['company-profile', 'makassar'],
                'status' => 'published',
                'published_at' => Carbon::parse('2026-02-18 14:00:00'),
                'seo_title' => 'Company Profile Website untuk Bisnis yang Lebih Kredibel | Frametech',
                'seo_description' => 'Tanda bisnis Anda sudah butuh company profile website untuk presentasi layanan yang lebih rapi dan profesional.',
                'seo_keywords' => 'company profile website, website bisnis, jasa company profile',
            ],
            [
                'title' => 'Aplikasi Web Internal untuk Merapikan Operasional Tanpa Menambah Spreadsheet Baru',
                'slug' => 'aplikasi-web-internal-untuk-merapikan-operasional',
                'excerpt' => 'Aplikasi web internal membantu tim merapikan proses order, data pelanggan, dan pekerjaan berulang yang sebelumnya tercecer di banyak file.',
                'content' => implode("\n\n", [
                    'Banyak bisnis mulai merasakan bottleneck saat data tersebar di chat, spreadsheet, dan catatan manual. Aplikasi web internal membantu menyatukan alur kerja ke satu sistem yang lebih terukur.',
                    'Use case paling umum biasanya ada pada dashboard admin, tracking order, katalog internal, lead management, dan approval workflow sederhana.',
                    'Pendekatan MVP lebih efektif daripada membangun sistem besar sejak awal. Mulai dari bottleneck utama, ukur dampaknya, lalu iterasi.',
                ]),
                'category' => 'aplikasi-web',
                'tags' => ['aplikasi-bisnis', 'ui-ux'],
                'status' => 'draft',
                'published_at' => null,
                'seo_title' => 'Aplikasi Web Internal untuk Operasional yang Lebih Rapi | Frametech',
                'seo_description' => 'Aplikasi web internal membantu bisnis merapikan operasional, order, dan data pelanggan tanpa alur kerja yang tercecer.',
                'seo_keywords' => 'aplikasi web internal, dashboard admin, aplikasi bisnis',
            ],
            [
                'title' => 'SEO Lokal Makassar: Kenapa Website Masih Penting untuk Bisnis Jasa',
                'slug' => 'seo-lokal-makassar-kenapa-website-masih-penting',
                'excerpt' => 'SEO lokal tetap membutuhkan website sebagai fondasi utama agar bisnis jasa lebih mudah muncul saat orang mencari solusi di area terdekat.',
                'content' => implode("\n\n", [
                    'Google tetap membutuhkan halaman yang jelas untuk memahami siapa Anda, layanan apa yang ditawarkan, dan area mana yang dilayani. Website menjadi fondasi penting untuk itu.',
                    'Untuk bisnis jasa, halaman layanan yang spesifik per niche atau area sering memberi hasil lebih baik daripada satu halaman generik yang terlalu luas.',
                    'SEO lokal yang efektif harus disertai NAP yang konsisten, struktur halaman yang jelas, dan CTA yang mudah dijangkau dari perangkat mobile.',
                ]),
                'category' => 'seo-lokal-makassar',
                'tags' => ['seo', 'makassar'],
                'status' => 'published',
                'published_at' => Carbon::parse('2026-03-01 08:15:00'),
                'seo_title' => 'SEO Lokal Makassar untuk Bisnis Jasa | Frametech',
                'seo_description' => 'Alasan website tetap penting untuk SEO lokal Makassar dan bagaimana menggunakannya untuk menarik calon pelanggan jasa.',
                'seo_keywords' => 'seo lokal makassar, website jasa makassar, seo bisnis lokal',
            ],
        ];

        foreach ($posts as $post) {
            $category = BlogCategory::query()
                ->where('slug', $post['category'])
                ->first();

            $record = Post::query()->updateOrCreate(
                ['slug' => $post['slug']],
                [
                    'author_id' => $author->id,
                    'category_id' => $category?->id,
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'cover_image' => null,
                    'status' => $post['status'],
                    'seo_title' => $post['seo_title'],
                    'seo_description' => $post['seo_description'],
                    'seo_keywords' => $post['seo_keywords'],
                    'published_at' => $post['published_at'],
                ],
            );

            $tagIds = BlogTag::query()
                ->whereIn('slug', $post['tags'])
                ->pluck('id')
                ->all();

            $record->tags()->sync($tagIds);
        }
    }
}
