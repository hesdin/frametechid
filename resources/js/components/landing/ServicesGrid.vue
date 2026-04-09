<script setup lang="ts">
import { computed } from 'vue';
import { serviceIconMap } from '@/lib/marketing';
import type { PublicService } from '@/types';

const props = defineProps<{
    services?: PublicService[];
}>();

const fallbackServices: PublicService[] = [
    {
        title: 'Jasa Pembuatan Website UMKM',
        description:
            'Cocok untuk usaha yang ingin tampil lebih profesional dan mudah ditemukan pelanggan baru di Makassar.',
        iconKey: 'store',
    },
    {
        title: 'Company Profile Website',
        description:
            'Menampilkan profil perusahaan, layanan, proyek, dan kontak dalam tampilan yang meyakinkan.',
        iconKey: 'building-2',
    },
    {
        title: 'Jasa Pembuatan Aplikasi Web',
        description:
            'Pengembangan aplikasi web internal untuk dashboard admin, booking, katalog, atau workflow bisnis.',
        iconKey: 'monitor-smartphone',
    },
];

const services = computed(() => props.services?.length ? props.services : fallbackServices);
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
                        <component :is="serviceIconMap[service.iconKey] ?? serviceIconMap['layout-grid']" :size="28" />
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
