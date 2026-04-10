<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    Facebook,
    Link2,
    Linkedin,
    Send,
    UserRound,
} from 'lucide-vue-next';
import { computed } from 'vue';
import CTA from '@/components/landing/CTA.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { blog } from '@/routes';
import { show } from '@/routes/blog';
import type { PublicBlogDetail, PublicBlogPost } from '@/types/blog';

const props = defineProps<{
    post: PublicBlogDetail;
    latestPosts: PublicBlogPost[];
}>();

const articlePath = computed(() => show({ slug: props.post.slug }).url);

const articleUrl = computed(() =>
    typeof window !== 'undefined'
        ? new URL(articlePath.value, window.location.origin).toString()
        : articlePath.value,
);

const contentParagraphs = computed(() =>
    props.post.content
        .split(/\n{2,}/)
        .map((paragraph: string) => paragraph.trim())
        .filter(Boolean),
);

const shareLinks = computed(() => [
    {
        label: 'Copy Link',
        href: articleUrl.value,
        icon: Link2,
    },
    {
        label: 'Facebook',
        href: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(articleUrl.value)}`,
        icon: Facebook,
    },
    {
        label: 'LinkedIn',
        href: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(articleUrl.value)}`,
        icon: Linkedin,
    },
    {
        label: 'Telegram',
        href: `https://t.me/share/url?url=${encodeURIComponent(articleUrl.value)}&text=${encodeURIComponent(props.post.title)}`,
        icon: Send,
    },
]);

function copyArticleUrl(event: MouseEvent): void {
    event.preventDefault();

    if (typeof navigator === 'undefined' || !navigator.clipboard) {
        return;
    }

    void navigator.clipboard.writeText(articleUrl.value);
}
</script>

<template>
    <Head :title="`${post.title} | Frametech`">
        <meta name="description" :content="post.excerpt" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
        <link
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
    </Head>

    <LandingLayout>
        <Navbar current-page="blog" theme="brand" />
        <main class="bg-[linear-gradient(180deg,#f4f9fd_0%,#ffffff_26%,#f5f9fd_100%)]">
            <section class="relative overflow-hidden py-12 md:py-16">
                <div
                    aria-hidden="true"
                    class="pointer-events-none absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_top_right,rgba(33,119,184,0.12),transparent_45%),radial-gradient(circle_at_top_left,rgba(246,170,26,0.12),transparent_40%)]"
                />
                <div
                    class="relative mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
                >
                    <div>
                        <Link
                            :href="blog().url"
                            class="inline-flex items-center gap-2 text-[14px] text-[#6e7892] transition-colors hover:text-[#2177b8]"
                        >
                            <ArrowLeft :size="16" />
                            <span>Kembali</span>
                        </Link>

                        <div class="mt-8 text-center">
                            <h1
                                class="mx-auto max-w-[760px] text-[28px] leading-[1.45] font-semibold tracking-[-0.03em] text-[#2f334e] md:text-[40px]"
                            >
                                {{ post.title }}
                            </h1>
                            <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
                                <span
                                    v-if="post.category"
                                    class="rounded-full bg-[#eef5fb] px-3 py-1 text-[12px] font-semibold text-[#2177b8]"
                                >
                                    {{ post.category }}
                                </span>
                                <span
                                    v-for="tag in post.tags"
                                    :key="tag"
                                    class="rounded-full bg-[#fff4de] px-3 py-1 text-[12px] font-semibold text-[#de8a00]"
                                >
                                    {{ tag }}
                                </span>
                            </div>
                            <p class="mt-4 text-[15px] text-[#8a90a7]">
                                {{ post.publishedAt }}
                            </p>
                        </div>

                        <div class="mt-10 overflow-hidden rounded-[28px] border border-[#dce8f4] bg-[#eef5fb] shadow-[0_18px_36px_rgba(31,91,143,0.10)]">
                            <img
                                :src="
                                    post.coverImage ??
                                    'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=80'
                                "
                                :alt="post.title"
                                class="h-[260px] w-full object-cover md:h-[520px]"
                            />
                        </div>
                    </div>

                    <div class="mt-12 grid gap-8 lg:grid-cols-[72px_minmax(0,1fr)]">
                        <aside class="hidden lg:block">
                            <div class="sticky top-28">
                                <p
                                    class="text-[12px] font-semibold tracking-[0.18em] text-[#99a0b5] uppercase"
                                >
                                    Share
                                </p>
                                <div class="mt-4 grid gap-3">
                                    <a
                                        v-for="item in shareLinks"
                                        :key="item.label"
                                        :href="item.href"
                                        :target="item.label === 'Copy Link' ? undefined : '_blank'"
                                        :rel="item.label === 'Copy Link' ? undefined : 'noopener noreferrer'"
                                        :aria-label="item.label"
                                        class="grid h-11 w-11 place-items-center rounded-full border border-[#dce8f4] bg-white text-[#5d6b85] transition-colors hover:border-[#2177b8] hover:text-[#2177b8]"
                                        @click="item.label === 'Copy Link' ? copyArticleUrl($event) : null"
                                    >
                                        <component :is="item.icon" :size="18" />
                                    </a>
                                </div>
                            </div>
                        </aside>

                        <article class="min-w-0">
                            <div class="rounded-[26px] border border-[#dce8f4] bg-white p-6 shadow-[0_14px_26px_rgba(31,91,143,0.08)] md:p-8">
                                <div class="flex items-start gap-4">
                                <span
                                    class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[linear-gradient(135deg,#2177b8_0%,#2b8dd7_100%)] text-white"
                                >
                                    <UserRound :size="20" />
                                </span>
                                <div class="text-[14px] leading-[1.85] text-[#4f586e] md:text-[16px]">
                                    <p class="font-semibold text-[#2f334e]">
                                        {{ post.author }}
                                    </p>
                                    <p class="mt-3">
                                        {{ post.excerpt }}
                                    </p>
                                </div>
                            </div>

                                <div class="mt-10 space-y-5 text-[#434b61]">
                                    <p
                                        v-for="(paragraph, index) in contentParagraphs"
                                        :key="index"
                                        class="text-[15px] leading-[1.95] md:text-[16px]"
                                    >
                                        {{ paragraph }}
                                    </p>
                                </div>
                            </div>

                            <div
                                v-if="latestPosts.length > 0"
                                class="mt-12 rounded-[24px] border border-[#dce8f4] bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] p-6"
                            >
                                <p
                                    class="text-[12px] font-semibold tracking-[0.18em] text-[#99a0b5] uppercase"
                                >
                                    Artikel lain
                                </p>
                                <div class="mt-5 grid gap-4 md:grid-cols-3">
                                    <Link
                                        v-for="item in latestPosts"
                                        :key="item.slug"
                                        :href="show({ slug: item.slug }).url"
                                        class="rounded-[18px] border border-[#dce8f4] bg-white p-4 shadow-[0_10px_20px_rgba(31,91,143,0.05)] transition hover:-translate-y-0.5"
                                    >
                                        <p class="text-[13px] text-[#8a90a7]">
                                            {{ item.publishedAt }}
                                        </p>
                                        <p
                                            v-if="item.category"
                                            class="mt-2 text-[12px] font-semibold text-[#2177b8]"
                                        >
                                            {{ item.category }}
                                        </p>
                                        <p
                                            class="mt-2 text-[16px] leading-[1.55] font-semibold text-[#2f334e]"
                                        >
                                            {{ item.title }}
                                        </p>
                                    </Link>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <CTA
                title="Siap Tampil Lebih Profesional Secara Online?"
                description="Mulai dari website yang tepat dan biarkan kami bantu bisnis kamu makin percaya diri di dunia online."
                theme="brand"
            />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
