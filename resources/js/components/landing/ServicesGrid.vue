<script setup lang="ts">
import {
    BedDouble,
    BriefcaseBusiness,
    Building2,
    LayoutGrid,
    Megaphone,
    NotebookText,
    School,
    ShoppingCart,
    Store,
} from 'lucide-vue-next';

const services = [
    {
        icon: Store,
        title: 'Website UMKM & Bisnis Lokal',
        description:
            'Cocok untuk usaha yang ingin tampil lebih profesional dan mudah ditemukan pelanggan baru.',
    },
    {
        icon: Building2,
        title: 'Company Profile Website',
        description:
            'Menampilkan profil perusahaan, layanan, proyek, dan kontak dalam tampilan yang meyakinkan.',
    },
    {
        icon: ShoppingCart,
        title: 'E-Commerce / Online Store',
        description:
            'Website toko online yang memudahkan katalog produk, order, dan integrasi promosi digital.',
    },
    {
        icon: Megaphone,
        title: 'Landing Page Promosi',
        description:
            'Ideal untuk kampanye iklan, peluncuran produk, atau penawaran jasa yang butuh fokus konversi.',
    },
    {
        icon: BedDouble,
        title: 'Website Villa / Penginapan',
        description:
            'Menampilkan kamar, fasilitas, galeri, hingga informasi reservasi dengan tampilan lebih premium.',
    },
    {
        icon: NotebookText,
        title: 'Website Katalog Produk',
        description:
            'Memudahkan bisnis menampilkan daftar produk atau layanan secara rapi tanpa harus jualan penuh online.',
    },
    {
        icon: School,
        title: 'Website Sekolah / Kursus',
        description:
            'Memuat profil lembaga, program belajar, pendaftaran, dan informasi penting untuk siswa maupun orang tua.',
    },
    {
        icon: BriefcaseBusiness,
        title: 'Website Portofolio',
        description:
            'Menampilkan hasil kerja, pengalaman, dan keahlian agar personal brand atau agensi lebih dipercaya.',
    },
    {
        icon: LayoutGrid,
        title: 'Custom Website',
        description:
            'Jika kebutuhan bisnis lebih spesifik, kami bisa menyesuaikan struktur dan fitur website sesuai tujuanmu.',
    },
];
</script>

<template>
    <section id="layanan" class="bg-[linear-gradient(180deg,#f5f9fd_0%,#ffffff_100%)] py-24 md:py-28">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
            <div class="mx-auto max-w-[700px] text-center">
                <h2 class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]">
                    Layanan Utama yang Kami Sediakan
                </h2>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <article v-for="service in services" :key="service.title"
                    class="rounded-[22px] border border-[#dce8f4] bg-white px-7 py-8 text-center">
                    <span
                        class="mx-auto grid h-[64px] w-[64px] place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white shadow-[0_12px_20px_rgba(36,110,169,0.18)]">
                        <component :is="service.icon" :size="28" />
                    </span>

                    <h3 class="mt-6 text-[17px] leading-[1.4] font-semibold text-[#2a2e49] md:text-[18px]">
                        {{ service.title }}
                    </h3>
                    <p class="mt-4 text-[14px] leading-[1.75] text-[#6e7691] md:text-[15px]">
                        {{ service.description }}
                    </p>
                </article>
            </div>
        </div>
    </section>
</template>
