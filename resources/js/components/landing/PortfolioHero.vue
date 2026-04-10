<script setup lang="ts">
import {
    BriefcaseBusiness,
    Camera,
    LayoutPanelTop,
    MessageCircleMore,
} from 'lucide-vue-next';
</script>

<template>
    <section
        id="hero"
        class="relative overflow-hidden bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)] pt-9 pb-14 md:pt-11 md:pb-18"
    >
        <div
            aria-hidden="true"
            class="pointer-events-none absolute top-0 right-0 h-[190px] w-[190px] bg-[linear-gradient(90deg,rgba(33,119,184,0.18)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.16)_66.66%_100%),linear-gradient(rgba(33,119,184,0.18)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.16)_66.66%_100%)] opacity-80"
        />

        <div
            class="mx-auto grid w-[min(1280px,calc(100%-1.5rem))] items-center gap-8 md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[0.92fr_1.08fr] lg:gap-10"
        >
            <div class="max-w-[500px]">
                <h1
                    class="text-[28px] leading-[1.42] font-semibold tracking-[-0.03em] text-[#2f334e] md:text-[40px]"
                >
                    Portofolio Website &amp; Aplikasi Bisnis yang Sudah Kami
                    Kerjakan
                </h1>

                <p
                    class="mt-4 max-w-[450px] text-[14px] leading-[1.75] text-[#66708a] md:text-[15px]"
                >
                    Lihat contoh website dan aplikasi web yang sudah kami
                    kerjakan untuk berbagai industri, mulai dari UMKM,
                    hospitality, hingga bisnis profesional di Makassar.
                </p>

                <div class="mt-7">
                    <a
                        href="#portfolio"
                        class="inline-flex items-center justify-center rounded-[10px] border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-7 py-[11px] text-[14px] font-semibold text-white shadow-[0_3px_0_0_rgba(167,103,0,0.85)_inset]"
                    >
                        Lihat Portofolio
                    </a>
                </div>
            </div>

            <div class="relative min-h-[360px] sm:min-h-[470px]">
                <div class="absolute inset-0 rounded-[36px]" />

                <article
                    class="absolute top-2 left-0 z-[4] inline-flex min-w-[200px] items-center gap-3 rounded-[22px] border border-[#d9e4ef] bg-white px-4 py-3 shadow-[0_16px_24px_rgba(43,87,124,0.12)] sm:min-w-[260px] sm:px-5 sm:py-4"
                >
                    <span
                        class="grid h-[52px] w-[52px] shrink-0 place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white sm:h-[62px] sm:w-[62px]"
                    >
                        <BriefcaseBusiness :size="23" />
                    </span>
                    <div>
                        <p
                            class="text-[15px] font-semibold text-[#1f79bc] sm:text-[16px]"
                        >
                            100+ Project
                        </p>
                        <p
                            class="mt-1 text-[14px] font-semibold text-[#252b44] sm:text-[16px]"
                        >
                            Sudah Dikerjakan
                        </p>
                    </div>
                </article>

                <img
                    src="/images/landing/hero-portfolio.png"
                    alt="Contoh tampilan website portofolio yang dibuat Frametech"
                    loading="eager"
                    decoding="async"
                    fetchpriority="high"
                    class="pointer-events-none absolute bottom-[-36px] left-1/2 z-[3] w-[min(420px,84%)] -translate-x-1/2 object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] sm:bottom-[-44px] sm:w-[min(470px,82%)]"
                />

                <article
                    class="absolute right-4 bottom-6 z-[4] inline-flex min-w-[200px] items-center gap-3 rounded-[22px] border border-[#d9e4ef] bg-white px-4 py-3 shadow-[0_16px_24px_rgba(43,87,124,0.12)] sm:min-w-[260px] sm:px-5 sm:py-4"
                >
                    <span
                        class="grid h-[52px] w-[52px] shrink-0 place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white sm:h-[62px] sm:w-[62px]"
                    >
                        <LayoutPanelTop :size="23" />
                    </span>
                    <div>
                        <p
                            class="text-[15px] font-semibold text-[#1f79bc] sm:text-[16px]"
                        >
                            32+
                        </p>
                        <p
                            class="mt-1 text-[14px] font-semibold text-[#252b44] sm:text-[16px]"
                        >
                            Template Variatif
                        </p>
                    </div>
                </article>

                <span
                    class="absolute top-[22%] right-[8%] z-[4] grid h-[54px] w-[54px] place-items-center rounded-full bg-gradient-to-b from-[#eda60f] to-[#d88600] text-white shadow-[0_12px_18px_rgba(179,114,0,0.2)]"
                >
                    <Camera :size="20" />
                </span>

                <span
                    class="absolute bottom-[20%] left-[10%] z-[4] grid h-[54px] w-[54px] place-items-center rounded-full bg-gradient-to-b from-[#eda60f] to-[#d88600] text-white shadow-[0_12px_18px_rgba(179,114,0,0.2)]"
                >
                    <MessageCircleMore :size="20" />
                </span>

                <span
                    aria-hidden="true"
                    class="absolute top-[32%] right-[24%] h-2.5 w-2.5 rounded-full bg-[#de8a00]"
                />
                <span
                    aria-hidden="true"
                    class="absolute top-[58%] left-[24%] h-2.5 w-2.5 rounded-full bg-[#de8a00]"
                />
                <span
                    aria-hidden="true"
                    class="absolute right-[10%] bottom-[18%] h-3.5 w-3.5 rounded-full bg-[#de8a00]"
                />
            </div>
        </div>
    </section>
</template>
