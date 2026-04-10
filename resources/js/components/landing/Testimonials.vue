<script setup lang="ts">
import { Quote } from 'lucide-vue-next';
import { computed } from 'vue';
import type { PublicTestimonial } from '@/types';

const props = withDefaults(
    defineProps<{
        sectionId?: string;
        title?: string;
        description?: string;
        backgroundClass?: string;
        theme?: 'blue' | 'red' | 'brand';
        items?: PublicTestimonial[];
    }>(),
    {
        sectionId: 'testimoni',
        title: 'Apa Kata Klien Tentang Frametech',
        description:
            'Pengalaman klien adalah bukti paling nyata dari kualitas kerja kami. Testimoni ini menggambarkan bagaimana proses kerja, komunikasi, dan hasil website yang mereka rasakan setelah bekerja bersama Frametech.',
        backgroundClass: 'bg-[#f3f3f6]',
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');

const defaultTestimonials: PublicTestimonial[] = [
    {
        quote: 'Tim Frametech mampu mengeksekusi ide yang kami inginkan dengan sangat baik. Website perusahaan kami menjadi sangat jelas dan tentunya menarik. Frametech adalah solusi tepat untuk seluruh UMKM di Indonesia, Very Recommended!',
        name: 'Jordan Sasmito',
        role: 'Co-Founder Coral Cafe Penida',
        avatar: 'https://images.unsplash.com/photo-1527980965255-d3b416303d12?auto=format&fit=crop&w=220&q=80',
        rating: 5,
    },
    {
        quote: 'Website yang dibangun oleh Frametech berhasil merepresentasikan brand kami dengan baik. Tim Frametech sangat komunikatif, memahami kebutuhan kami, dan hasil akhirnya melebihi ekspektasi. Highly recommended!',
        name: 'Reinaldy Lamdjani',
        role: 'Founder Ruang Kopi',
        avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=220&q=80',
        rating: 5,
    },
    {
        quote: 'Saya telah bekerja sama dengan Frametech dan terkesan dengan kualitas dan perhatian mereka terhadap detail. Tim Frametech punya kemampuan luar biasa dalam membuat website yang menarik secara visual sekaligus mudah digunakan.',
        name: 'Ahmed Noor Khan',
        role: 'Founder Azura Network',
        avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=220&q=80',
        rating: 5,
    },
];
</script>

<template>
    <section :id="props.sectionId" :class="[props.backgroundClass, 'py-24 md:py-28']">
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
            <div class="mx-auto max-w-[1080px] text-center">
                <h2 class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]">
                    {{ props.title }}
                </h2>
                <p class="mx-auto mt-5 max-w-[820px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]">
                    {{ props.description }}
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <article v-for="item in props.items?.length ? props.items : defaultTestimonials" :key="item.name" :class="[
                    'rounded-[26px] bg-white px-8 py-9',
                    isBrandTheme
                        ? 'border border-[#dce8f4]'
                        : 'border border-[#ececf1]',
                ]">
                    <Quote :size="26" :stroke-width="1.8" :class="isBrandTheme
                            ? 'text-[#de8a00]'
                            : isRedTheme
                                ? 'text-[#d85b5b]'
                                : 'text-[#4e99df]'
                        " />
                    <p class="mt-5 text-[14px] leading-[1.75] text-[#3b4159] md:text-[15px]">
                        {{ item.quote }}
                    </p>
                    <p class="mt-5 text-[13px] font-semibold tracking-[0.16em] text-[#de8a00] uppercase">
                        {{ '★'.repeat(item.rating) }}
                    </p>
                    <div class="mt-8 flex items-center gap-4">
                        <img :src="item.avatar" :alt="item.name" class="h-[56px] w-[56px] rounded-full object-cover" />
                        <span>
                            <strong class="block text-[18px] leading-tight font-semibold text-[#2a2e49]">{{ item.name
                                }}</strong>
                            <span class="mt-2 block text-[14px] leading-tight text-[#6f7690] md:text-[15px]">{{
                                item.role }}</span>
                        </span>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
