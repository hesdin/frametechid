<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { blogPosts } from '@/data/blog';
import { show } from '@/routes/blog';
</script>

<template>
    <section
        class="bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] py-24 md:py-28"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="grid gap-10 md:grid-cols-2 xl:grid-cols-3">
                <article
                    v-for="post in blogPosts"
                    :key="post.slug"
                    class="max-w-[390px]"
                >
                    <Link
                        :href="show({ slug: post.slug }).url"
                        class="block rounded-[26px] border border-[#dce8f4] bg-white p-4 shadow-[0_14px_26px_rgba(31,91,143,0.08)] transition-transform duration-300 hover:-translate-y-1"
                    >
                        <div
                            class="overflow-hidden rounded-[22px] bg-[#eef5fb]"
                        >
                            <img
                                :src="post.image"
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
                            {{ post.date }}
                        </p>
                    </Link>
                </article>
            </div>
        </div>
    </section>
</template>
