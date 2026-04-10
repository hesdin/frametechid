<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BusinessTypes from '@/components/landing/BusinessTypes.vue';
import CTA from '@/components/landing/CTA.vue';
import Faq from '@/components/landing/Faq.vue';
import Features from '@/components/landing/Features.vue';
import Footer from '@/components/landing/Footer.vue';
import Hero from '@/components/landing/Hero.vue';
import Navbar from '@/components/landing/Navbar.vue';
import Portfolio from '@/components/landing/Portfolio.vue';
import ProcessSteps from '@/components/landing/ProcessSteps.vue';
import ServicesGrid from '@/components/landing/ServicesGrid.vue';
import Testimonials from '@/components/landing/Testimonials.vue';
import WhyChoose from '@/components/landing/WhyChoose.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
import type {
    PageSeo,
    PublicFaqItem,
    PublicPortfolioItem,
    PublicService,
    PublicTestimonial,
} from '@/types';

defineProps<{
    featuredServices: PublicService[];
    featuredPortfolioItems: PublicPortfolioItem[];
    testimonials: PublicTestimonial[];
    faqs: PublicFaqItem[];
    seo: PageSeo;
}>();
</script>

<template>
    <Head :title="seo.title">
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
        <Navbar current-page="home" theme="brand" />
        <main>
            <Hero />
            <ServicesGrid :services="featuredServices" />
            <Features theme="brand" />
            <WhyChoose theme="brand" />
            <BusinessTypes
                background-class="bg-[linear-gradient(180deg,#eef7fd_0%,#fff7e8_100%)]"
                accent-theme="brand"
            />
            <Portfolio :projects="featuredPortfolioItems" theme="brand" />
            <ProcessSteps theme="brand" />
            <Testimonials
                :items="testimonials"
                background-class="bg-[#f5f9fd]"
                theme="brand"
            />
            <Faq :items="faqs" />
            <CTA theme="brand" />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
