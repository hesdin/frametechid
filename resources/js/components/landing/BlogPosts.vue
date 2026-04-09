<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { show } from '@/routes/blog';
import type { PublicBlogPost } from '@/types/blog';

defineProps<{
    posts: PublicBlogPost[];
}>();
</script>

<template>
    <section
        class="bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] py-24 md:py-28"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div
                v-if="posts.length === 0"
                class="mb-10 rounded-[28px] border border-dashed border-[#dce8f4] bg-white/80 px-6 py-16 text-center shadow-[0_14px_26px_rgba(31,91,143,0.06)]"
            >
                <p class="text-[18px] font-semibold text-[#2f334e]">
                    Artikel sedang disiapkan.
                </p>
                <p class="mt-3 text-[15px] leading-[1.75] text-[#8a90a7]">
                    Tim Frametech lagi menyiapkan tulisan baru. Cek lagi sebentar ya.
                </p>
            </div>

            <div class="grid gap-10 md:grid-cols-2 xl:grid-cols-3">
                <article
                    v-for="post in posts"
                    :key="post.slug"
                    class="max-w-[390px]"
                >
                    <Link
                        :href="show({ slug: post.slug }).url"
                        class="block rounded-[26px] border border-[#dce8f4] bg-white p-4 shadow-[0_14px_26px_rgba(31,91,143,0.08)] transition-transform duration-300 hover:-translate-y-1"
                    >
                        <div class="overflow-hidden rounded-[22px] bg-[#eef5fb]">
                            <img
                                :src="
                                    post.coverImage ??
                                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=80'
                                "
                                :alt="post.title"
                                class="h-[210px] w-full object-cover"
                            />
                        </div>
                        <h2
                            class="mt-6 text-[18px] leading-[1.45] font-semibold tracking-[-0.02em] text-[#2f334e] md:text-[20px]"
                        >
                            {{ post.title }}
                        </h2>
                        <p class="mt-4 text-[15px] text-[#8a90a7]">
                            {{ post.publishedAt }}
                        </p>
                        <p class="mt-3 text-[15px] leading-[1.75] text-[#5b6479]">
                            {{ post.excerpt }}
                        </p>
                    </Link>
                </article>
            </div>
        </div>
    </section>
</template>
