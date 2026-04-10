<script setup lang="ts">
import { Menu, MessageCircle, X } from 'lucide-vue-next';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import { useSiteSettings } from '@/composables/useSiteSettings';
import { about, blog, home, portfolio, pricing, services } from '@/routes';

const props = withDefaults(
    defineProps<{
        currentPage?:
        | 'home'
        | 'services'
        | 'pricing'
        | 'portfolio'
        | 'about'
        | 'blog';
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        currentPage: 'home',
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');
const isMobileMenuOpen = ref(false);
const { site } = useSiteSettings();

const links = computed(() => [
    {
        label: 'Beranda',
        href: props.currentPage === 'home' ? '#hero' : home().url,
    },
    { label: 'Layanan', href: services().url },
    { label: 'Paket & Harga', href: pricing().url },
    { label: 'Portofolio', href: portfolio().url },
    { label: 'Tentang Kami', href: about().url },
    { label: 'Blog', href: blog().url },
]);

const isScrolled = ref(false);
const linkHoverClass = computed(() =>
    isBrandTheme.value
        ? 'hover:text-[#cf7f00]'
        : isRedTheme.value
            ? 'hover:text-[#d54343]'
            : 'hover:text-[#2095e7]',
);
const mobileMenuButtonClass = computed(() =>
    isBrandTheme.value
        ? 'border-[#d5e4f2] text-[#cf7f00]'
        : isRedTheme.value
            ? 'border-[#f0d5d5] text-[#d54343]'
            : 'border-[#d5e8f7] text-[#2095e7]',
);
const consultationButtonClass = computed(() =>
    isBrandTheme.value
        ? 'border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(208,134,0,0.3)]'
        : isRedTheme.value
            ? 'border-[#cc4b4b] bg-gradient-to-b from-[#f26969] to-[#d84040] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(194,67,67,0.3)]'
            : 'border-[#1d8ed9] bg-gradient-to-b from-[#1bb0fb] to-[#0e8ddd] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(22,114,181,0.3)]',
);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 12;
};

const handleResize = () => {
    if (window.innerWidth >= 1280) {
        isMobileMenuOpen.value = false;
    }
};

const toggleMobileMenu = (): void => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const closeMobileMenu = (): void => {
    isMobileMenuOpen.value = false;
};

onMounted(() => {
    handleScroll();
    handleResize();
    window.addEventListener('scroll', handleScroll, { passive: true });
    window.addEventListener('resize', handleResize);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
    window.removeEventListener('resize', handleResize);
});
</script>

<template>
    <header :class="[
        'sticky top-0 z-[70] pt-3 pb-3 transition-colors duration-300',
        isScrolled
            ? 'bg-transparent'
            : isBrandTheme
                ? 'bg-[#eef6fc]'
                : isRedTheme
                    ? 'bg-[#fff0f0]'
                    : 'bg-[#E1F3FF]',
    ]">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
            <nav
                class="flex items-center gap-3 rounded-[24px] border border-[#d9e5f0] bg-white px-4 py-3 shadow-[0_12px_28px_rgba(22,63,98,0.08)] transition-all duration-300 md:px-6 md:py-4">
                <a :href="home().url" class="inline-flex shrink-0 items-center gap-2" :aria-label="site.siteName">
                    <img src="/images/landing/logo-frametech.png" alt="" class="hidden" aria-hidden="true" />
                    <img :src="site.logoUrl" alt=""
                        class="h-6 w-6 shrink-0 object-contain md:h-7 md:w-7" aria-hidden="true" />
                    <span
                        class="text-[20px] leading-none font-semibold tracking-[-0.01em] text-[#27324a] md:text-[28px]">
                        {{ site.siteName }}
                    </span>
                </a>

                <ul
                    class="mx-1 hidden flex-1 items-center justify-center gap-6 text-[15px] font-medium whitespace-nowrap text-[#75809a] xl:flex xl:gap-8 xl:text-[16px]">
                    <li v-for="link in links" :key="link.label">
                        <a :href="link.href" :class="['transition-colors', linkHoverClass]">
                            {{ link.label }}
                        </a>
                    </li>
                </ul>

                <button type="button"
                    class="ml-auto inline-flex h-11 w-11 items-center justify-center rounded-[14px] border bg-white transition-colors xl:hidden"
                    :class="mobileMenuButtonClass" :aria-expanded="isMobileMenuOpen" aria-controls="landing-mobile-menu"
                    aria-label="Toggle navigation menu" @click="toggleMobileMenu">
                    <Menu v-if="!isMobileMenuOpen" :size="21" />
                    <X v-else :size="21" />
                </button>

                <a :href="site.whatsappUrl" :class="[
                    'ml-auto hidden shrink-0 items-center justify-center gap-2 rounded-[14px] border-2 px-3 py-2 text-sm leading-none font-semibold text-white transition-transform hover:-translate-y-px xl:inline-flex xl:px-5 xl:py-[14px] xl:text-[18px]',
                    consultationButtonClass,
                ]">
                    <MessageCircle :size="20" />
                    <span>Konsultasi Sekarang</span>
                </a>
            </nav>

            <div v-if="isMobileMenuOpen" id="landing-mobile-menu"
                class="mt-3 rounded-[24px] border border-[#d3e0ed] bg-white/95 p-4 shadow-[0_18px_32px_rgba(22,63,98,0.08)] xl:hidden">
                <ul class="space-y-2 text-[15px] font-medium text-[#75809a]">
                    <li v-for="link in links" :key="`${link.label}-mobile`">
                        <a :href="link.href" :class="[
                            'flex items-center rounded-[14px] px-4 py-3 transition-colors',
                            linkHoverClass,
                        ]" @click="closeMobileMenu">
                            {{ link.label }}
                        </a>
                    </li>
                </ul>

                <a :href="site.whatsappUrl" :class="[
                    'mt-4 inline-flex w-full items-center justify-center gap-2 rounded-[14px] border-2 px-4 py-3 text-sm leading-none font-semibold text-white transition-transform hover:-translate-y-px',
                    consultationButtonClass,
                ]" @click="closeMobileMenu">
                    <MessageCircle :size="20" />
                    <span>Konsultasi Sekarang</span>
                </a>
            </div>
        </div>
    </header>
</template>
