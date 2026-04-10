<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Jordan Sasmito',
                'role' => 'Co-Founder Coral Cafe Penida',
                'quote' => 'Tim Frametech mampu mengeksekusi ide yang kami inginkan dengan sangat baik. Website perusahaan kami menjadi sangat jelas dan menarik. Sangat cocok untuk bisnis yang ingin terlihat lebih profesional.',
                'avatar_url' => 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?auto=format&fit=crop&w=220&q=80',
                'rating' => 5,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'name' => 'Reinaldy Lamdjani',
                'role' => 'Founder Ruang Kopi',
                'quote' => 'Website yang dibangun berhasil merepresentasikan brand kami dengan baik. Timnya komunikatif, memahami kebutuhan bisnis, dan hasil akhirnya melebihi ekspektasi.',
                'avatar_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=220&q=80',
                'rating' => 5,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'name' => 'Ahmed Noor Khan',
                'role' => 'Founder Azura Network',
                'quote' => 'Saya terkesan dengan kualitas dan perhatian mereka terhadap detail. Tim Frametech mampu membuat website yang menarik secara visual sekaligus mudah digunakan.',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=220&q=80',
                'rating' => 5,
                'sort_order' => 3,
                'is_published' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->updateOrCreate(
                ['name' => $testimonial['name']],
                $testimonial,
            );
        }
    }
}
