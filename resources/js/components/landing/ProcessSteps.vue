<script setup lang="ts">
import {
    BarChart3,
    Globe,
    Image,
    LayoutGrid,
    MapPin,
    Monitor,
    PenTool,
    Phone,
    Sparkles,
} from 'lucide-vue-next';
import { computed } from 'vue';

const steps = [
    {
        label: 'Langkah 1',
        title: 'Konsultasi & Persiapan Konten',
        description:
            'Tahap awal untuk memahami kebutuhan bisnismu dan menyiapkan seluruh materi yang dibutuhkan.',
        intro: 'Di tahap ini Anda dapat mengirimkan:',
        items: [
            {
                icon: Image,
                text: 'Foto produk atau tampilan usaha',
            },
            {
                icon: Sparkles,
                text: 'Logo usaha',
            },
            {
                icon: Phone,
                text: 'Informasi kontak dan media sosial',
            },
            {
                icon: MapPin,
                text: 'Detail penting seperti alamat dan jam operasional',
            },
        ],
    },
    {
        label: 'Langkah 2',
        title: 'Desain & Pengembangan Website',
        description:
            'Kami merancang dan membangun website sesuai kebutuhan bisnismu dengan tampilan yang profesional.',
        intro: 'Di tahap ini Anda akan menerima:',
        items: [
            {
                icon: Monitor,
                text: 'Desain awal untuk ditinjau',
            },
            {
                icon: LayoutGrid,
                text: 'Konten yang telah disusun',
            },
            {
                icon: PenTool,
                text: 'Revisi desain maksimal 2 kali',
            },
        ],
    },
    {
        label: 'Langkah 3',
        title: 'Website Siap Digunakan',
        description:
            'Website akan dipublikasikan dan siap digunakan oleh pelanggan secara online.',
        intro: 'Di tahap ini Anda akan menerima:',
        items: [
            {
                icon: Globe,
                text: 'Link website yang siap digunakan',
            },
            {
                icon: BarChart3,
                text: 'Akses ke statistik pengunjung',
            },
        ],
    },
];

const props = withDefaults(
    defineProps<{
        sectionId?: string;
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        sectionId: 'harga',
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');
</script>

<template>
    <section :id="props.sectionId" :class="[
        'py-20 md:py-24',
        isBrandTheme
            ? 'bg-[linear-gradient(180deg,#f1f8fd_0%,#fff7e8_100%)]'
            : isRedTheme
                ? 'bg-[#fff1f1]'
                : 'bg-[#dff0fc]',
    ]">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
            <div class="mx-auto max-w-[980px] text-center">
                <h2 class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]">
                    Proses Pembuatan Website yang Jelas dan Terarah
                </h2>
                <p class="mx-auto mt-5 max-w-[860px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]">
                    Kami menjalankan proses pembuatan website secara terstruktur
                    agar website yang dihasilkan rapi, mudah digunakan, dan siap
                    mendukung kebutuhan bisnis sejak hari pertama.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <article v-for="step in steps" :key="step.label" :class="[
                    'flex h-full flex-col rounded-[28px] bg-white px-7 py-8 md:px-8 md:py-10',
                    isBrandTheme
                        ? 'border border-[#dce8f4]'
                        : 'border border-[#e8edf3]',
                ]">
                    <span :class="[
                        'mx-auto inline-flex items-center justify-center rounded-full px-6 py-[10px] text-[18px] leading-tight font-semibold text-white',
                        isBrandTheme
                            ? 'border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[0_3px_0_0_rgba(183,116,0,0.9)_inset]'
                            : isRedTheme
                                ? 'border border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040] shadow-[0_3px_0_0_rgba(167,46,46,0.9)_inset]'
                                : 'border border-[#0d81d4] bg-gradient-to-b from-[#22affd] to-[#0d8bd9] shadow-[0_3px_0_0_rgba(6,121,194,0.9)_inset]',
                    ]">
                        {{ step.label }}
                    </span>

                    <h3
                        class="mt-8 text-center text-[18px] leading-[1.35] font-semibold tracking-[-0.01em] text-[#2a2e49] md:text-[20px]">
                        {{ step.title }}
                    </h3>
                    <p
                        class="mx-auto mt-5 max-w-[380px] text-center text-[14px] leading-[1.7] text-[#6e7691] md:text-[15px]">
                        {{ step.description }}
                    </p>

                    <div class="my-6 h-px w-full bg-[#eceff4]" />

                    <p class="text-center text-[14px] leading-[1.7] text-[#6e7691] md:text-[15px]">
                        {{ step.intro }}
                    </p>

                    <ul class="mt-5 grid gap-4">
                        <li v-for="item in step.items" :key="item.text" :class="[
                            'inline-flex items-center gap-3 rounded-[14px] px-5 py-4 text-[14px] leading-[1.45] font-medium text-[#2a2e49] md:text-[15px]',
                            isBrandTheme ? 'bg-[#edf5fc]' : 'bg-[#edf3fb]',
                        ]">
                            <component :is="item.icon" :size="22" :class="[
                                'shrink-0',
                                isBrandTheme
                                    ? 'text-[#1f79bc]'
                                    : isRedTheme
                                        ? 'text-[#d85b5b]'
                                        : 'text-[#4f9fe9]',
                            ]" />
                            <span>{{ item.text }}</span>
                        </li>
                    </ul>
                </article>
            </div>
        </div>
    </section>
</template>
