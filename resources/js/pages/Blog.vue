<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BlogHero from '@/components/landing/BlogHero.vue';
import BlogPosts from '@/components/landing/BlogPosts.vue';
import CTA from '@/components/landing/CTA.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
import type { PublicBlogPost } from '@/types/blog';

defineProps<{
    posts: PublicBlogPost[];
}>();
</script>

<template>
    <Head title="Blog | Frametech">
        <meta
            name="description"
            content="Artikel seputar jasa pembuatan aplikasi, website bisnis, dan SEO lokal Makassar dari Frametech."
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin=""
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
    </Head>

    <LandingLayout>
        <Navbar current-page="blog" theme="brand" />
        <main>
            <BlogHero />
            <BlogPosts :posts="posts" />
            <CTA
                title="Siap Tampil Lebih Profesional Secara Online?"
                description="Mulai dari konsultasi gratis, kami urus semuanya untuk Anda."
                theme="brand"
            />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
