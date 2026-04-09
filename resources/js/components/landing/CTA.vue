<script setup lang="ts">
import { MessageCircle } from 'lucide-vue-next';
import { computed } from 'vue';
import { useSiteSettings } from '@/composables/useSiteSettings';

const props = withDefaults(
    defineProps<{
        title?: string;
        description?: string;
        buttonLabel?: string;
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        title: 'Siap Membuat Website Profesional Untuk Bisnismu?',
        buttonLabel: 'Konsultasi Gratis Sekarang',
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');
const { site } = useSiteSettings();

const resolvedDescription = computed(
    () =>
        props.description ||
        `Tim ${site.value.siteName} siap membantu dari tahap awal hingga website siap digunakan untuk mendukung pertumbuhan bisnismu.`,
);
</script>

<template>
    <section id="contact" :class="[
        'relative overflow-hidden',
        isBrandTheme
            ? 'bg-[linear-gradient(180deg,#eef7fd_0%,#fff6e4_100%)]'
            : isRedTheme
                ? 'bg-[#fff0f0]'
                : 'bg-[#dbeaf7]',
    ]">
        <div aria-hidden="true" :class="[
            'pointer-events-none absolute bottom-0 left-0 h-[170px] w-[170px]',
            isBrandTheme
                ? 'bg-[linear-gradient(90deg,rgba(33,119,184,0.24)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%),linear-gradient(rgba(33,119,184,0.24)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%)]'
                : isRedTheme
                    ? 'bg-[linear-gradient(90deg,rgba(228,171,171,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(228,171,171,0.2)_66.66%_100%),linear-gradient(rgba(228,171,171,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(228,171,171,0.2)_66.66%_100%)]'
                    : 'bg-[linear-gradient(90deg,rgba(173,198,221,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(173,198,221,0.2)_66.66%_100%),linear-gradient(rgba(173,198,221,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(173,198,221,0.2)_66.66%_100%)]',
        ]" />

        <div
            class="mx-auto grid w-[min(1280px,calc(100%-1.5rem))] items-center gap-8 py-3 md:w-[min(1280px,calc(100%-2.5rem))] md:py-5 lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[1fr_1.03fr] lg:py-6">
            <div class="relative z-10 max-w-[560px]">
                <h2 class="text-[18px] leading-[1.35] font-bold tracking-[-0.02em] text-[#272b45] md:text-[30px]">
                    {{ props.title }}
                </h2>
                <p class="mt-5 max-w-[500px] text-[15px] leading-[1.7] text-[#6b7088] md:text-[16px]">
                    {{ resolvedDescription }}
                </p>

                <div class="mt-8">
                    <a :href="site.whatsappUrl" :class="[
                        'inline-flex w-full items-center justify-center gap-3 rounded-[14px] border-2 px-6 py-3.5 text-[15px] leading-none font-semibold text-white transition-transform hover:-translate-y-px sm:w-auto sm:min-w-[360px] sm:text-[16px]',
                        isBrandTheme
                            ? 'border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(214,136,0,0.28)]'
                            : isRedTheme
                                ? 'border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(185,67,67,0.28)]'
                                : 'border-[#1d88d3] bg-gradient-to-b from-[#1cb0fb] to-[#108fdd] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(28,128,196,0.28)]',
                    ]">
                        <MessageCircle :size="22" :stroke-width="2.2" />
                        <span>{{ props.buttonLabel }}</span>
                    </a>
                </div>
            </div>

            <div class="relative hidden min-h-[520px] lg:flex lg:items-center lg:justify-end">
                <div class="relative h-[520px] w-full origin-top-right translate-y-8 scale-[0.86]">
                    <img src="/images/landing/cta.png" alt="Ilustrasi layanan website Frametech"
                        class="pointer-events-none absolute bottom-[-44px] left-[53%] z-20 w-[460px] -translate-x-1/2 object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]" />
                    <div
                        class="absolute top-8 left-[-36px] z-10 inline-flex min-w-[380px] items-center gap-4 rounded-[30px] border border-[#dce5ef] bg-[#fcfdff] px-6 py-5 shadow-[0_12px_26px_rgba(38,73,106,0.13)]">
                        <span :class="[
                            'grid h-[78px] w-[78px] shrink-0 place-items-center rounded-full',
                            isBrandTheme
                                ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af]'
                                : isRedTheme
                                    ? 'bg-gradient-to-b from-[#f06f6f] to-[#d44242]'
                                    : 'bg-gradient-to-b from-[#1cb1fb] to-[#0f8edf]',
                        ]">
                            <span class="h-6 w-8 rounded-lg border-2 border-white" />
                        </span>
                        <div>
                            <p :class="[
                                'inline-flex items-center gap-2 text-[22px] leading-none font-semibold',
                                isBrandTheme
                                    ? 'text-[#1f79bc]'
                                    : isRedTheme
                                        ? 'text-[#d45b5b]'
                                        : 'text-[#4b92d4]',
                            ]">
                                12
                                <span
                                    class="inline-flex items-center rounded-full bg-[#27ba5d] px-3 py-1 text-[13px] leading-none font-bold text-white">
                                    ▲ 22%
                                </span>
                            </p>
                            <p class="mt-2 text-[16px] leading-tight font-semibold text-[#2b2f45]">
                                Formulir Kontak Masuk
                            </p>
                        </div>
                    </div>
                    <div
                        class="absolute right-2 bottom-[-10px] z-30 inline-flex min-w-[320px] items-center gap-4 rounded-[30px] border border-[#dce5ef] bg-[#fcfdff] px-6 py-5 shadow-[0_12px_26px_rgba(38,73,106,0.13)]">
                        <span :class="[
                            'grid h-[78px] w-[78px] shrink-0 place-items-center rounded-full text-[36px] text-white',
                            isBrandTheme
                                ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af]'
                                : isRedTheme
                                    ? 'bg-gradient-to-b from-[#f06f6f] to-[#d44242]'
                                    : 'bg-gradient-to-b from-[#1cb1fb] to-[#0f8edf]',
                        ]">
                            ★
                        </span>
                        <div>
                            <p :class="[
                                'text-[22px] leading-none font-semibold',
                                isBrandTheme
                                    ? 'text-[#1f79bc]'
                                    : isRedTheme
                                        ? 'text-[#d45b5b]'
                                        : 'text-[#4b92d4]',
                            ]">
                                4.8/5
                            </p>
                            <p class="mt-2 text-[16px] leading-tight font-semibold text-[#2b2f45]">
                                Rating Bisnismu
                            </p>
                        </div>
                    </div>

                    <span aria-hidden="true" :class="[
                        'absolute top-[4.5rem] right-20 z-10 h-3 w-3 rounded-full',
                        isBrandTheme
                            ? 'bg-gradient-to-b from-[#eda60f] to-[#d88600]'
                            : isRedTheme
                                ? 'bg-gradient-to-b from-[#f38a8a] to-[#d44242]'
                                : 'bg-gradient-to-b from-[#34acee] to-[#108ddd]',
                    ]" />
                    <span aria-hidden="true" :class="[
                        'absolute top-[10.5rem] right-0 z-10 h-7 w-7 rounded-full',
                        isBrandTheme
                            ? 'bg-gradient-to-b from-[#eda60f] to-[#d88600]'
                            : isRedTheme
                                ? 'bg-gradient-to-b from-[#f38a8a] to-[#d44242]'
                                : 'bg-gradient-to-b from-[#34acee] to-[#108ddd]',
                    ]" />
                    <span aria-hidden="true" :class="[
                        'absolute right-[42%] bottom-9 z-10 h-4 w-4 rounded-full',
                        isBrandTheme
                            ? 'bg-gradient-to-b from-[#eda60f] to-[#d88600]'
                            : isRedTheme
                                ? 'bg-gradient-to-b from-[#f38a8a] to-[#d44242]'
                                : 'bg-gradient-to-b from-[#34acee] to-[#108ddd]',
                    ]" />
                    <span aria-hidden="true" :class="[
                        'absolute bottom-24 left-[10%] z-10 h-24 w-24 rounded-full',
                        isBrandTheme
                            ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af] shadow-[0_16px_24px_rgba(36,110,169,0.28)]'
                            : isRedTheme
                                ? 'bg-gradient-to-b from-[#f16b6b] to-[#d64040] shadow-[0_16px_24px_rgba(179,72,72,0.28)]'
                                : 'bg-gradient-to-b from-[#22affd] to-[#0d8ad9] shadow-[0_16px_24px_rgba(18,112,181,0.28)]',
                    ]" />
                </div>
            </div>
        </div>
    </section>
</template>
