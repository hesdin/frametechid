<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AboutFocus from '@/components/landing/AboutFocus.vue';
import AboutHero from '@/components/landing/AboutHero.vue';
import AboutMission from '@/components/landing/AboutMission.vue';
import AboutReasons from '@/components/landing/AboutReasons.vue';
import AboutStory from '@/components/landing/AboutStory.vue';
import CTA from '@/components/landing/CTA.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import Testimonials from '@/components/landing/Testimonials.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
</script>

<template>
    <Head title="Tentang Kami | Frametech">
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
        <Navbar current-page="about" theme="brand" />
        <main>
            <AboutHero />
            <AboutStory />
            <AboutMission />
            <AboutFocus />
            <AboutReasons />
            <Testimonials
                title="Mereka Udah Go Digital Bareng Frametech"
                description="Beberapa cerita dari klien yang sudah merasakan dampak website bersama Frametech."
                background-class="bg-[#f5f9fd]"
                theme="brand"
            />
            <CTA
                title="Siap Tampil Lebih Profesional Secara Online?"
                description="Frametech siap membantu bisnis lokalmu punya website yang rapi, jelas, dan siap berkembang."
                theme="brand"
            />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
