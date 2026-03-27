<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');

const projects = [
    {
        title: 'Serata Engineering - Perusahaan Teknik & Industri',
        link: 'https://example.com/serata-engineering',
        desktopImage:
            'https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1598128558393-70ff21433be0?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Coral Cafe Penida - Coffee & Eatery',
        link: 'https://example.com/coral-cafe-penida',
        desktopImage:
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Ruang Kopi - Coffee Roastery',
        link: 'https://example.com/ruang-kopi',
        desktopImage:
            'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Sun & Sari - Travel Agency',
        link: 'https://example.com/sun-sari-travel',
        desktopImage:
            'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?auto=format&fit=crop&w=900&q=80',
    },
];
</script>

<template>
    <section id="portfolio" class="py-20 md:py-24">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[980px] text-center">
                <h2
                    class="text-[22px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[34px]"
                >
                    Beberapa Proyek yang Telah Kami Kerjakan
                </h2>
                <p
                    class="mx-auto mt-5 max-w-[900px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]"
                >
                    Kami telah membantu berbagai UMKM dan bisnis lokal memiliki
                    website yang rapi, mudah digunakan, dan benar-benar
                    merepresentasikan karakter brand mereka.
                </p>
            </div>

            <div class="mt-12 grid gap-8 lg:grid-cols-2">
                <article
                    v-for="project in projects"
                    :key="project.title"
                    class="group"
                >
                    <a
                        :href="project.link"
                        target="_blank"
                        rel="noopener noreferrer"
                        :class="[
                            'block overflow-hidden rounded-[22px] px-4 pt-4 md:px-5 md:pt-5',
                            isBrandTheme
                                ? 'border border-[#dce8f4] bg-[#eef5fb]'
                                : 'border border-[#e4e6ea] bg-[#f0f1f4]',
                        ]"
                    >
                        <div
                            class="relative h-[220px] md:h-[280px] lg:h-[320px]"
                        >
                            <img
                                :src="project.desktopImage"
                                :alt="`${project.title} desktop`"
                                class="absolute inset-y-0 left-0 h-full w-[78%] rounded-[10px] border border-black/5 object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                            />
                            <img
                                :src="project.mobileImage"
                                :alt="`${project.title} mobile`"
                                class="absolute top-0 right-0 h-full w-[24%] rounded-[10px] border border-black/10 object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                            />
                        </div>
                    </a>
                    <div class="px-1 pt-4">
                        <h3
                            class="text-[18px] leading-[1.35] font-semibold tracking-[-0.01em] text-[#2a2e49] md:text-[20px]"
                        >
                            {{ project.title }}
                        </h3>
                    </div>
                </article>
            </div>

            <div class="mt-14 text-center">
                <a
                    href="#kontak"
                    :class="[
                        'inline-flex items-center justify-center rounded-[16px] px-14 py-[14px] text-[15px] font-semibold text-white transition-transform hover:-translate-y-px md:text-[16px]',
                        isBrandTheme
                            ? 'border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[0_3px_0_0_rgba(183,116,0,0.9)_inset]'
                            : isRedTheme
                              ? 'border border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040]'
                              : 'border border-[#067ed1] bg-gradient-to-b from-[#21affd] to-[#0d8bd9]',
                    ]"
                >
                    Lihat Semua
                </a>
            </div>
        </div>
    </section>
</template>
