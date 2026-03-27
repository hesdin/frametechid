<script setup lang="ts">
import { Check, ChevronDown } from 'lucide-vue-next';

const plans = [
    {
        name: 'Paket Mulai',
        summary:
            'Cocok untuk bisnis yang baru mulai go online dan butuh website yang ringkas.',
        previousPrice: 'Rp1.500.000',
        price: 'Rp1.500.000',
        discount: 'Diskon 50%',
        note: 'Harga terbaik untuk mulai tampil online dengan rapi.',
        cta: 'Pilih Sekarang',
        features: [
            '3 Halaman Website',
            'Gratis Domain & Hosting',
            'Desain premium sesuai brand bisnis',
            'Konten website dibantu penyusunan',
            'Bebas konsultasi revisi sampai basic fix',
        ],
    },
    {
        name: 'Paket Tumbuh',
        summary:
            'Untuk bisnis yang butuh halaman lebih lengkap, struktur lebih rapi, dan tampilan lebih kuat.',
        previousPrice: 'Rp4.500.000',
        price: 'Rp4.500.000',
        discount: 'Diskon 35%',
        note: 'Paket paling cocok untuk brand yang sedang berkembang.',
        cta: 'Pilih Paket Ini',
        features: [
            'Company Profile lengkap',
            'Fitur form WhatsApp',
            'SEO lokal dan map link',
            'Support basic fitur tambahan',
            'Halaman produk/layanan dan galeri hingga 10 item',
        ],
    },
    {
        name: 'Paket Maju',
        summary:
            'Paket paling lengkap untuk usaha yang butuh website lebih detail dan siap tampil premium.',
        previousPrice: 'Rp8.500.000',
        price: 'Rp8.500.000',
        discount: 'Diskon 45%',
        note: 'Untuk brand dengan kebutuhan presentasi lebih eksklusif.',
        cta: 'Pilih Premium',
        features: [
            'Semua fitur tumbuh',
            'Desain yang lebih eksklusif',
            'Katalog produk lebih banyak',
            'Free revisi dan support hingga 3 bulan',
            'Custom section dan fitur minor',
        ],
    },
];
</script>

<template>
    <section id="harga" class="bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] py-24 md:py-28">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
            <div class="mx-auto max-w-[860px] text-center">
                <h2 class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]">
                    Solusi Website Sesuai Kebutuhan Bisnismu
                </h2>
                <p class="mx-auto mt-5 max-w-[780px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]">
                    Pilih paket yang paling cocok dengan kebutuhan, target
                    pertumbuhan, dan tingkat kompleksitas website bisnismu.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <article v-for="(plan, index) in plans" :key="plan.name"
                    class="flex h-full flex-col rounded-[26px] border border-[#dce8f4] bg-white px-7 py-8">
                    <span :class="[
                        'grid h-[56px] w-[56px] place-items-center rounded-full text-[18px] font-semibold',
                        index === 0
                            ? 'bg-[linear-gradient(180deg,#f2ddca_0%,#d79f68_100%)] text-[#734822]'
                            : index === 1
                                ? 'bg-[linear-gradient(180deg,#f3f3f3_0%,#bcc0c7_100%)] text-[#5f6268]'
                                : 'bg-[linear-gradient(180deg,#f5e08d_0%,#d8aa27_100%)] text-[#6e5510]',
                    ]">
                        {{ plan.name.charAt(6) }}
                    </span>

                    <h3 class="mt-5 text-[18px] leading-tight font-semibold text-[#2a2e49]">
                        {{ plan.name }}
                    </h3>
                    <p class="mt-3 text-[14px] leading-[1.75] text-[#6e7691] md:text-[15px]">
                        {{ plan.summary }}
                    </p>

                    <div class="mt-6">
                        <p class="text-[13px] text-[#9aa1b4] line-through md:text-[14px]">
                            {{ plan.previousPrice }}
                        </p>
                        <div class="mt-2 flex items-center gap-3">
                            <strong class="text-[24px] leading-none font-semibold text-[#1f79bc]">
                                {{ plan.price }}
                            </strong>
                            <span class="rounded-full bg-[#fff5e5] px-3 py-1 text-[12px] font-semibold text-[#de8a00]">
                                {{ plan.discount }}
                            </span>
                        </div>
                        <p class="mt-3 text-[13px] text-[#7a8096]">
                            {{ plan.note }}
                        </p>
                    </div>

                    <ul class="mt-7 grid gap-3">
                        <li v-for="feature in plan.features" :key="feature"
                            class="inline-flex items-start gap-3 rounded-[12px] bg-[#eef5fc] px-4 py-3 text-[14px] leading-[1.55] text-[#4a5269]">
                            <span
                                class="mt-[2px] inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#2c87c9] text-white">
                                <Check :size="12" :stroke-width="3" />
                            </span>
                            <span>{{ feature }}</span>
                        </li>
                    </ul>

                    <details class="mt-5 border-t border-[#eceff4] pt-5">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between text-[14px] font-medium text-[#6e7691]">
                            <span>Lihat Selengkapnya</span>
                            <ChevronDown :size="18" class="transition-transform group-open:rotate-180" />
                        </summary>
                        <p class="mt-4 text-[14px] leading-[1.7] text-[#7b8097]">
                            Detail final paket akan disesuaikan dengan struktur
                            halaman, jumlah konten, dan kebutuhan bisnismu.
                        </p>
                    </details>

                    <a href="#contact"
                        class="mt-7 inline-flex items-center justify-center rounded-[12px] border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-6 py-3 text-[15px] font-semibold text-white shadow-[0_3px_0_0_rgba(167,103,0,0.9)_inset]">
                        {{ plan.cta }}
                    </a>
                </article>
            </div>
        </div>
    </section>
</template>
