<script setup lang="ts">
import {
    Globe,
    Megaphone,
    MessageCircle,
    ShoppingBag,
    Users,
} from 'lucide-vue-next';
</script>

<template>
    <section
        id="hero"
        class="relative overflow-hidden bg-[linear-gradient(180deg,#f4f9fd_0%,#edf6fd_60%,#fff5e3_100%)]"
    >
        <div
            aria-hidden="true"
            class="pointer-events-none absolute bottom-0 left-0 h-[160px] w-[160px] bg-[linear-gradient(90deg,rgba(33,119,184,0.22)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%),linear-gradient(rgba(33,119,184,0.22)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%)] opacity-80"
        />

        <div
            class="mx-auto grid min-h-[calc(100vh-108px)] w-[min(1280px,calc(100%-1.5rem))] grid-cols-1 items-center gap-6 py-6 md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[1fr_1.02fr]"
        >
            <div class="max-w-[600px]">
                <p
                    class="text-[16px] leading-[1.2] font-semibold text-[#dd8800] sm:text-[18px] lg:text-[20px]"
                >
                    #BisnisLokalGoDigital
                </p>

                <h1
                    class="mt-4 text-[24px] leading-[1.44] font-semibold tracking-[-0.03em] text-balance text-[#2f334e] sm:text-[30px] lg:mt-5 lg:text-[40px]"
                >
                    Jasa Pembuatan Website Profesional untuk UMKM &amp; Bisnis
                    Lokal
                </h1>

                <p
                    class="mt-4 max-w-[500px] text-[14px] leading-[1.65] text-[#5f6d84] sm:text-[15px] lg:mt-5 lg:text-[16px]"
                >
                    Website modern yang rapi, cepat, dan dirancang untuk bantu
                    bisnis lokal tampil lebih meyakinkan dan dipercaya
                    pelanggan.
                </p>

                <div class="mt-6 flex flex-wrap gap-3 lg:mt-7 lg:gap-4">
                    <a
                        href="#contact"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl border-2 border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-5 py-3 text-[15px] leading-none font-semibold text-white shadow-[inset_0_2px_0_rgba(255,255,255,0.25),0_10px_22px_rgba(214,136,0,0.28)] transition-transform hover:-translate-y-px sm:w-auto sm:px-6 sm:py-3.5 sm:text-[15px]"
                    >
                        <MessageCircle :size="22" />
                        <span>Konsultasi Gratis Sekarang</span>
                    </a>
                    <a
                        href="#portfolio"
                        class="inline-flex w-full items-center justify-center rounded-xl border border-[#cfe0ef] bg-white/90 px-5 py-3 text-[15px] leading-none font-semibold text-[#1f71af] shadow-[0_10px_24px_rgba(36,94,143,0.08)] sm:w-auto sm:min-w-[240px] sm:px-6 sm:py-3.5 sm:text-[15px]"
                    >
                        Lihat Portofolio Kami
                    </a>
                </div>
            </div>

            <div
                class="relative min-h-[420px] sm:min-h-[560px] lg:min-h-[620px]"
            >
                <div
                    class="absolute inset-0 rounded-full border border-[#d9e7f4] bg-[radial-gradient(circle_at_54%_42%,rgba(255,255,255,0.96)_0_30%,rgba(232,243,251,0.86)_44%,rgba(255,244,216,0.58)_68%,rgba(244,164,18,0.08)_100%),repeating-radial-gradient(circle_at_62%_44%,rgba(34,122,186,0.14)_0_1px,transparent_1px_8px)]"
                />

                <img
                    src="/images/landing/hero-home-page.png"
                    alt="Tim Frametech membantu bisnis lokal tampil profesional secara digital"
                    class="pointer-events-none absolute right-[2%] bottom-[-44px] z-[4] w-[min(380px,80%)] object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] sm:right-[4%] sm:bottom-[-52px] sm:w-[min(450px,76%)] lg:right-[2%] lg:bottom-[-64px] lg:w-[min(520px,82%)]"
                />

                <div
                    class="absolute top-[14%] right-[8%] z-[3] hidden h-[72px] w-[72px] place-items-center rounded-full bg-gradient-to-b from-[#eda60f] to-[#d88600] text-white shadow-[0_15px_24px_rgba(210,136,0,0.28)] sm:grid"
                >
                    <Globe :size="30" />
                </div>

                <div
                    class="absolute bottom-[18%] left-[8%] z-[3] hidden h-[72px] w-[72px] place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white shadow-[0_15px_24px_rgba(36,110,169,0.26)] sm:grid"
                >
                    <Megaphone :size="28" />
                </div>

                <article
                    class="absolute top-[10%] left-[0%] z-[3] inline-flex min-w-[260px] items-center gap-3 rounded-[20px] border border-[#d9e4ef] bg-white px-4 py-3 shadow-[0_18px_28px_rgba(43,87,124,0.15)] sm:top-[17%] sm:left-[2%] sm:min-w-[330px] sm:gap-4 sm:rounded-[27px] sm:px-5 sm:py-4"
                >
                    <span
                        class="grid h-[54px] w-[54px] shrink-0 place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white sm:h-[68px] sm:w-[68px]"
                    >
                        <ShoppingBag :size="21" />
                    </span>
                    <div>
                        <p
                            class="inline-flex items-center gap-2 text-[12px] leading-none font-semibold text-[#1f79bc] sm:text-[24px]"
                        >
                            34
                            <span
                                class="inline-flex items-center rounded-full bg-[#1fbf5b] px-[9px] py-[4px] text-[12px] leading-none font-bold text-white sm:px-[11px] sm:py-[5px] sm:text-[14px]"
                            >
                                ▲ 25%
                            </span>
                        </p>
                        <p
                            class="mt-1 text-[12px] leading-[1.2] font-semibold text-[#20263a] sm:mt-2 sm:text-[16px]"
                        >
                            Pesanan Baru Masuk
                        </p>
                    </div>
                </article>

                <article
                    class="absolute right-0 bottom-[8%] z-[5] inline-flex min-w-[260px] items-center gap-3 rounded-[20px] border border-[#d9e4ef] bg-white px-4 py-3 shadow-[0_18px_28px_rgba(43,87,124,0.15)] sm:bottom-[10%] sm:min-w-[330px] sm:gap-4 sm:rounded-[27px] sm:px-5 sm:py-4"
                >
                    <span
                        class="grid h-[54px] w-[54px] shrink-0 place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white sm:h-[68px] sm:w-[68px]"
                    >
                        <Users :size="21" />
                    </span>
                    <div>
                        <p
                            class="inline-flex items-center gap-2 text-[12px] leading-none font-semibold text-[#1f79bc] sm:text-[24px]"
                        >
                            88
                            <span
                                class="inline-flex items-center rounded-full bg-[#1fbf5b] px-[9px] py-[4px] text-[12px] leading-none font-bold text-white sm:px-[11px] sm:py-[5px] sm:text-[14px]"
                            >
                                ▲ 18%
                            </span>
                        </p>
                        <p
                            class="mt-1 text-[12px] leading-[1.2] font-semibold text-[#20263a] sm:mt-2 sm:text-[16px]"
                        >
                            Pengunjung Hari Ini
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
