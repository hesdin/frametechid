<script setup lang="ts">
import { MessageCircle } from 'lucide-vue-next';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
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

const handleScroll = () => {
    isScrolled.value = window.scrollY > 12;
};

onMounted(() => {
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header
        :class="[
            'sticky top-0 z-[70] pt-3 pb-3 transition-colors duration-300',
            isScrolled
                ? 'bg-transparent'
                : isBrandTheme
                  ? 'bg-[#eef6fc]'
                  : isRedTheme
                    ? 'bg-[#fff0f0]'
                    : 'bg-[#E1F3FF]',
        ]"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <nav
                class="flex items-center gap-3 rounded-[24px] border border-[#d9e5f0] bg-white px-4 py-3 shadow-[0_12px_28px_rgba(22,63,98,0.08)] transition-all duration-300 md:px-6 md:py-4"
            >
                <a
                    :href="home().url"
                    class="inline-flex shrink-0 items-center gap-2"
                    aria-label="Frametech"
                >
                    <img
                        src="/images/landing/logo-frametech.png"
                        alt=""
                        class="h-6 w-6 shrink-0 object-contain md:h-7 md:w-7"
                        aria-hidden="true"
                    />
                    <span
                        class="text-[20px] leading-none font-semibold tracking-[-0.01em] text-[#27324a] md:text-[28px]"
                    >
                        Frametech
                    </span>
                </a>

                <ul
                    class="mx-1 hidden flex-1 items-center justify-center gap-6 text-[15px] font-medium whitespace-nowrap text-[#75809a] xl:flex xl:gap-8 xl:text-[16px]"
                >
                    <li v-for="link in links" :key="link.label">
                        <a
                            :href="link.href"
                            :class="[
                                'transition-colors',
                                isBrandTheme
                                    ? 'hover:text-[#cf7f00]'
                                    : isRedTheme
                                      ? 'hover:text-[#d54343]'
                                      : 'hover:text-[#2095e7]',
                            ]"
                        >
                            {{ link.label }}
                        </a>
                    </li>
                </ul>

                <a
                    href="#contact"
                    :class="[
                        'ml-auto inline-flex shrink-0 items-center justify-center gap-2 rounded-[14px] border-2 px-3 py-2 text-sm leading-none font-semibold text-white transition-transform hover:-translate-y-px md:px-5 md:py-[14px] md:text-[18px]',
                        isBrandTheme
                            ? 'border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(208,134,0,0.3)]'
                            : isRedTheme
                              ? 'border-[#cc4b4b] bg-gradient-to-b from-[#f26969] to-[#d84040] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(194,67,67,0.3)]'
                              : 'border-[#1d8ed9] bg-gradient-to-b from-[#1bb0fb] to-[#0e8ddd] shadow-[inset_0_2px_0_rgba(255,255,255,0.23),0_8px_16px_rgba(22,114,181,0.3)]',
                    ]"
                >
                    <MessageCircle :size="20" />
                    <span class="hidden md:inline">Konsultasi Sekarang</span>
                    <span class="md:hidden">Konsultasi</span>
                </a>
            </nav>

            <ul
                class="mt-3 flex items-center gap-4 overflow-x-auto rounded-xl border border-[#d3e0ed] bg-white/90 px-4 py-2 text-sm font-medium whitespace-nowrap text-[#75809a] xl:hidden"
            >
                <li v-for="link in links" :key="`${link.label}-mobile`">
                    <a
                        :href="link.href"
                        :class="[
                            'transition-colors',
                            isBrandTheme
                                ? 'hover:text-[#cf7f00]'
                                : isRedTheme
                                  ? 'hover:text-[#d54343]'
                                  : 'hover:text-[#2095e7]',
                        ]"
                    >
                        {{ link.label }}
                    </a>
                </li>
            </ul>
        </div>
    </header>
</template>
