<script setup lang="ts">
import { Check, MessageCircle } from 'lucide-vue-next';
import { computed } from 'vue';
import { useSiteSettings } from '@/composables/useSiteSettings';

const fallbackShowcases = [
    {
        title: 'Interior',
        imageUrl:
            'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80',
    },
    {
        title: 'Produk',
        imageUrl:
            'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80',
    },
    {
        title: 'Hospitality',
        imageUrl:
            'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1600&q=80',
    },
    {
        title: 'Portfolio',
        imageUrl:
            'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80',
    },
    {
        title: 'Company',
        imageUrl:
            'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1600&q=80',
    },
];

const businessTypes = [
    'Cafe & Restaurant',
    'Klinik & Rumah Sakit',
    'Hotel & Villa',
    'Properti & Developer',
    'Wedding Organizer',
    'UMKM & Toko Online',
    'Travel & Rental',
    'Salon & Beauty Clinic',
    'Gym & Studio Fitness',
    'Sekolah & Kursus',
    'Konsultan & Jasa Profesional',
    'Retail & Brand Lokal',
    'Event Organizer',
    'Arsitek & Interior',
    'Startup & Company Profile',
];

const props = withDefaults(
    defineProps<{
        sectionId?: string;
        backgroundClass?: string;
        buttonHref?: string;
        accentTheme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        sectionId: undefined,
        backgroundClass: 'bg-[#dff0fc]',
        buttonHref: '#contact',
        accentTheme: 'blue',
    },
);

const isRedTheme = computed(() => props.accentTheme === 'red');
const isBrandTheme = computed(() => props.accentTheme === 'brand');
const { site } = useSiteSettings();

const showcases = computed(() =>
    site.value.businessTypesSlides.length > 0
        ? site.value.businessTypesSlides
        : fallbackShowcases,
);
</script>

<template>
    <section
        :id="props.sectionId"
        :class="['overflow-hidden py-24 md:py-28', props.backgroundClass]"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[1160px] text-center">
                <h2
                    class="text-[22px] leading-tight font-bold tracking-[-0.02em] text-[#252a44] md:text-[34px]"
                >
                    Website untuk Berbagai Jenis UMKM &amp; Bisnis Lokal
                </h2>
                <p
                    class="mx-auto mt-5 max-w-[1180px] text-[15px] leading-[1.9] text-[#6a708a] md:text-[16px]"
                >
                    Kami merancang website yang disesuaikan dengan karakter tiap
                    jenis bisnis, mulai dari usaha kecil hingga brand yang
                    sedang berkembang. Setiap tampilan disusun agar relevan
                    dengan target pasar, mudah dipahami, dan mendukung kebutuhan
                    operasional bisnis secara nyata.
                </p>
            </div>
        </div>

        <div
            class="relative left-1/2 mt-12 w-screen -translate-x-1/2 overflow-x-auto lg:overflow-hidden"
        >
            <div
                class="business-types-track flex w-max gap-7 px-5 md:px-7 lg:px-9"
            >
                <article
                    v-for="showcase in showcases"
                    :key="showcase.title"
                    class="relative h-[240px] w-[230px] shrink-0 overflow-hidden rounded-[30px] border border-white/45 shadow-[0_15px_30px_rgba(12,52,88,0.18)] md:h-[330px] md:w-[320px] lg:h-[410px] lg:w-[400px]"
                >
                    <img
                        :src="showcase.imageUrl"
                        :alt="`Contoh website ${showcase.title}`"
                        class="h-full w-full object-cover"
                    />
                </article>

                <article
                    v-for="showcase in showcases"
                    :key="`duplicate-${showcase.title}`"
                    class="relative h-[240px] w-[230px] shrink-0 overflow-hidden rounded-[30px] border border-white/45 shadow-[0_15px_30px_rgba(12,52,88,0.18)] md:h-[330px] md:w-[320px] lg:h-[410px] lg:w-[400px]"
                >
                    <img
                        :src="showcase.imageUrl"
                        :alt="`Contoh website ${showcase.title}`"
                        class="h-full w-full object-cover"
                    />
                </article>
            </div>
        </div>

        <div
            class="mx-auto mt-14 w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div
                class="grid justify-center gap-x-8 gap-y-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5"
            >
                <span
                    v-for="businessType in businessTypes"
                    :key="businessType"
                    class="inline-flex items-center gap-3 text-[14px] leading-tight font-semibold text-[#2b3048] md:text-[15px]"
                >
                    <span
                        :class="[
                            'inline-flex h-[26px] w-[26px] shrink-0 items-center justify-center rounded-full text-white',
                            isBrandTheme
                                ? 'bg-[#1f79bc]'
                                : isRedTheme
                                  ? 'bg-[#d85b5b]'
                                  : 'bg-[#4f9fe9]',
                        ]"
                    >
                        <Check :size="15" :stroke-width="3" />
                    </span>
                    <span>{{ businessType }}</span>
                </span>
            </div>

            <div class="mt-12 text-center">
                <a
                    :href="props.buttonHref"
                    :class="[
                        'inline-flex items-center justify-center gap-3 rounded-[16px] px-7 py-[14px] text-[15px] font-semibold text-white transition-transform hover:-translate-y-px md:text-[16px]',
                        isBrandTheme
                            ? 'border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[0_3px_0_0_rgba(183,116,0,0.9)_inset]'
                            : isRedTheme
                              ? 'border border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040] shadow-[0_3px_0_0_rgba(167,46,46,0.9)_inset]'
                              : 'border border-[#067ed1] bg-gradient-to-b from-[#21affd] to-[#0d8bd9] shadow-[0_3px_0_0_rgba(5,118,190,0.9)_inset]',
                    ]"
                >
                    <MessageCircle :size="24" />
                    Konsultasi Gratis Sekarang
                </a>
            </div>
        </div>
    </section>
</template>

<style scoped>
.business-types-track {
    animation: business-types-scroll-right 30s linear infinite;
}

@keyframes business-types-scroll-right {
    from {
        transform: translateX(-50%);
    }

    to {
        transform: translateX(0);
    }
}

@media (prefers-reduced-motion: reduce) {
    .business-types-track {
        animation: none;
    }
}
</style>
