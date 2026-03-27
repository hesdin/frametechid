<script setup lang="ts">
import { Globe, MonitorSmartphone, ShieldCheck } from 'lucide-vue-next';
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

const features = [
    {
        icon: Globe,
        title: 'Bisnis Lebih Kredibel',
        description:
            'Website membuat brand Anda terlihat lebih profesional dan dipercaya pelanggan baru.',
    },
    {
        icon: MonitorSmartphone,
        title: 'Mudah Diakses 24 Jam',
        description:
            'Informasi produk, kontak, dan katalog online bisa diakses kapan pun dari semua perangkat.',
    },
    {
        icon: ShieldCheck,
        title: 'Aset Digital Milik Anda',
        description:
            'Domain, hosting, dan konten dikelola rapi sehingga bisnis punya pondasi digital yang aman.',
    },
];
</script>

<template>
    <section
        id="layanan"
        :class="[
            'py-24 md:py-28',
            isBrandTheme
                ? 'bg-[#f5f9fd]'
                : isRedTheme
                  ? 'bg-[#fff7f7]'
                  : 'bg-[#F8F8F8]',
        ]"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[980px] text-center">
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]"
                >
                    Kenapa Bisnis Perlu Punya Website
                </h2>
                <p
                    class="mx-auto mt-5 max-w-[780px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]"
                >
                    Website bukan sekadar tampilan. Ini fondasi utama agar calon
                    pelanggan lebih mudah menemukan, menilai, dan menghubungi
                    bisnis Anda.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <article
                    v-for="feature in features"
                    :key="feature.title"
                    :class="[
                        'rounded-[26px] bg-white px-7 py-10 text-center md:px-8 md:py-11',
                        isBrandTheme
                            ? 'border border-[#dce8f4] shadow-[0_14px_28px_rgba(34,98,150,0.08)]'
                            : 'border border-[#ececf1]',
                    ]"
                >
                    <span
                        :class="[
                            'mx-auto grid h-[90px] w-[90px] place-items-center rounded-full text-white',
                            isBrandTheme
                                ? 'bg-gradient-to-b from-[#eda60f] to-[#d88600] shadow-[0_14px_26px_rgba(210,136,0,0.22)]'
                                : isRedTheme
                                  ? 'bg-gradient-to-b from-[#f06f6f] to-[#d44242] shadow-[0_14px_26px_rgba(179,72,72,0.22)]'
                                  : 'bg-gradient-to-b from-[#1db0fb] to-[#0f8edf] shadow-[0_14px_26px_rgba(16,100,159,0.22)]',
                        ]"
                    >
                        <component :is="feature.icon" :size="44" />
                    </span>
                    <h3
                        class="mt-7 text-[18px] leading-[1.35] font-semibold tracking-[-0.01em] text-[#2a2e49] md:text-[20px]"
                    >
                        {{ feature.title }}
                    </h3>
                    <p
                        class="mx-auto mt-4 max-w-[430px] text-[14px] leading-[1.7] text-[#6e7691] md:text-[15px]"
                    >
                        {{ feature.description }}
                    </p>
                </article>
            </div>
        </div>
    </section>
</template>
