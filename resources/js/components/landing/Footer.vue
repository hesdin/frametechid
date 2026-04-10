<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import {
    Facebook,
    Instagram,
    Linkedin,
    MessageCircle,
    Music2,
    Youtube,
} from 'lucide-vue-next';
import { computed } from 'vue';
import { useSiteSettings } from '@/composables/useSiteSettings';
import { about, blog, home, portfolio, pricing, services } from '@/routes';
import type { MarketingSharedData } from '@/types';

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
const { site } = useSiteSettings();
const page = usePage();

const serviceItems = computed(() => {
    const marketing = page.props.marketing as MarketingSharedData | undefined;

    return marketing?.footerServices?.length
        ? marketing.footerServices
        : [
              'Jasa Pembuatan Website',
              'Website Company Profile',
              'Website Toko Online',
              'Jasa Pembuatan Aplikasi Web',
              'Website Klinik',
              'Website Sekolah',
          ];
});

const pages = [
    { label: 'Beranda', href: home().url },
    { label: 'Layanan', href: services().url },
    { label: 'Paket & Harga', href: pricing().url },
    { label: 'Portofolio', href: portfolio().url },
    { label: 'Tentang Kami', href: about().url },
    { label: 'Blog', href: blog().url },
];

const socialLinks = computed(() =>
    [
        { label: 'Instagram', href: site.value.instagramUrl, icon: Instagram },
        { label: 'LinkedIn', href: site.value.linkedinUrl, icon: Linkedin },
        { label: 'Facebook', href: site.value.facebookUrl, icon: Facebook },
        { label: 'TikTok', href: site.value.tiktokUrl, icon: Music2 },
        { label: 'YouTube', href: site.value.youtubeUrl, icon: Youtube },
    ].filter((item) => item.href),
);
</script>

<template>
    <footer class="py-16 md:py-20">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div
                class="grid gap-10 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.05fr]"
            >
                <div class="max-w-[430px]">
                    <a
                        :href="home().url"
                        class="inline-flex items-center gap-2"
                        :aria-label="site.siteName"
                    >
                        <img
                            :src="site.logoUrl"
                            alt=""
                            class="h-9 w-9 shrink-0 object-contain"
                            aria-hidden="true"
                        />
                        <span
                            class="text-[28px] leading-none font-semibold tracking-[-0.01em] text-[#2a2e49]"
                        >
                            {{ site.siteName }}
                        </span>
                    </a>

                    <p
                        class="mt-6 text-[14px] leading-[1.65] text-[#6f7390] md:text-[16px]"
                    >
                        {{ site.companyDescription }}
                    </p>
                </div>

                <div>
                    <h4 class="text-[18px] font-semibold text-[#2a2e49]">
                        Layanan
                    </h4>
                    <ul
                        class="mt-6 grid gap-4 text-[14px] text-[#6f7390] md:text-[16px]"
                    >
                        <li v-for="service in serviceItems" :key="service">
                            {{ service }}
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[18px] font-semibold text-[#2a2e49]">
                        Halaman
                    </h4>
                    <ul
                        class="mt-6 grid gap-4 text-[14px] text-[#6f7390] md:text-[16px]"
                    >
                        <li v-for="page in pages" :key="page.label">
                            <a
                                :href="page.href"
                                :class="[
                                    'transition-colors',
                                    isBrandTheme
                                        ? 'hover:text-[#cf7f00]'
                                        : 'hover:text-[#2a2e49]',
                                ]"
                            >
                                {{ page.label }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[18px] font-semibold text-[#2a2e49]">
                        Hubungi Kami
                    </h4>
                    <a
                        :href="site.whatsappUrl"
                        :class="[
                            'mt-6 inline-flex w-full items-center justify-center gap-3 rounded-[16px] border-2 px-6 py-4 text-[17px] leading-none font-semibold text-white',
                            isBrandTheme
                                ? 'border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700]'
                                : isRedTheme
                                  ? 'border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040]'
                                  : 'border-[#1b88d2] bg-gradient-to-b from-[#1db1fc] to-[#0f8ddd]',
                        ]"
                    >
                        <MessageCircle :size="27" />
                        <span>{{ site.phoneNumber }}</span>
                    </a>

                    <p class="mt-5 text-[14px] text-[#6f7390] md:text-[16px]">
                        {{ site.businessHours }}
                    </p>

                    <p v-if="site.email" class="mt-3 text-[14px] text-[#6f7390] md:text-[16px]">
                        {{ site.email }}
                    </p>

                    <p v-if="site.address" class="mt-2 text-[14px] text-[#6f7390] md:text-[16px]">
                        {{ site.address }}
                    </p>

                    <div v-if="socialLinks.length > 0" class="mt-6 flex items-center gap-4">
                        <a
                            v-for="social in socialLinks"
                            :key="social.label"
                            :href="social.href ?? '#'"
                            :aria-label="social.label"
                            target="_blank"
                            rel="noopener noreferrer"
                            :class="[
                                'grid h-10 w-10 place-items-center rounded-full text-white transition-transform hover:-translate-y-px',
                                isBrandTheme
                                    ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af]'
                                    : isRedTheme
                                      ? 'bg-gradient-to-b from-[#f16b6b] to-[#d64040]'
                                      : 'bg-gradient-to-b from-[#25b2fc] to-[#0f8ddd]',
                            ]"
                        >
                            <component :is="social.icon" :size="22" />
                        </a>
                    </div>
                </div>
            </div>

            <p
                class="mt-14 border-t border-[#dedfe6] pt-8 text-center text-[16px] text-[#767b95] md:text-[17px]"
            >
                © {{ new Date().getFullYear() }} {{ site.siteName }} oleh
                {{ site.copyrightName }}. Hak cipta dilindungi.
            </p>
        </div>
    </footer>
</template>
