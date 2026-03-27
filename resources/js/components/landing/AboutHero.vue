<script setup lang="ts">
import { BriefcaseBusiness, Lightbulb, Rocket } from 'lucide-vue-next';
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
                    Frametech Hadir untuk Membawa Bisnis Lokal Naik Kelas
                </h1>

                <p
                    class="mt-4 max-w-[450px] text-[14px] leading-[1.75] text-[#66708a] md:text-[15px]"
                >
                    Kami hadir membantu bisnis lokal membangun citra digital
                    yang lebih rapi, dipercaya, dan siap berkembang lewat
                    website yang tepat guna.
                </p>

                <div class="mt-7">
                    <a
                        href="#tentang"
                        class="inline-flex items-center justify-center rounded-[10px] border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-7 py-[11px] text-[14px] font-semibold text-white shadow-[0_3px_0_0_rgba(167,103,0,0.85)_inset]"
                    >
                        Lihat Lebih Dekat
                    </a>
                </div>
            </div>

            <div class="relative min-h-[390px] sm:min-h-[520px]">
                <div class="absolute inset-0 rounded-[36px]" />
                <img
                    src="/images/landing/hero-tentang-kami.png"
                    alt="Tampilan halaman tentang kami Frametech"
                    class="pointer-events-none absolute bottom-[-36px] left-1/2 z-[3] w-[112%] max-w-[980px] -translate-x-1/2 object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] sm:bottom-[-44px] sm:w-[118%] lg:bottom-[-56px] lg:w-[124%]"
                />

                <span
                    class="absolute top-[20%] left-[14%] z-[4] grid h-[54px] w-[54px] place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white shadow-[0_12px_18px_rgba(36,110,169,0.2)]"
                >
                    <BriefcaseBusiness :size="20" />
                </span>
                <span
                    class="absolute top-[22%] right-[7%] z-[4] grid h-[54px] w-[54px] place-items-center rounded-full bg-gradient-to-b from-[#eda60f] to-[#d88600] text-white shadow-[0_12px_18px_rgba(179,114,0,0.2)]"
                >
                    <Lightbulb :size="20" />
                </span>
                <span
                    class="absolute right-[16%] bottom-[18%] z-[4] grid h-[54px] w-[54px] place-items-center rounded-full bg-gradient-to-b from-[#eda60f] to-[#d88600] text-white shadow-[0_12px_18px_rgba(179,114,0,0.2)]"
                >
                    <Rocket :size="20" />
                </span>

                <span
                    aria-hidden="true"
                    class="absolute top-[31%] right-[22%] h-2.5 w-2.5 rounded-full bg-[#de8a00]"
                />
                <span
                    aria-hidden="true"
                    class="absolute bottom-[24%] left-[24%] h-2.5 w-2.5 rounded-full bg-[#de8a00]"
                />
            </div>
        </div>
    </section>
</template>
