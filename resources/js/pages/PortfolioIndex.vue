<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import CTA from '@/components/landing/CTA.vue';
import Faq from '@/components/landing/Faq.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import PortfolioGallery from '@/components/landing/PortfolioGallery.vue';
import PortfolioHero from '@/components/landing/PortfolioHero.vue';
import ProcessSteps from '@/components/landing/ProcessSteps.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
import type { PageSeo, PublicPortfolioItem } from '@/types';

defineProps<{
    items: PublicPortfolioItem[];
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
        <Navbar current-page="portfolio" theme="brand" />
        <main>
            <PortfolioHero />
            <PortfolioGallery :projects="items" />
            <ProcessSteps section-id="proses" theme="brand" />
            <Faq
                title="Proses Terstruktur untuk Hasil yang Maksimal"
                description="Jawaban ringkas untuk pertanyaan yang paling sering muncul seputar pengerjaan, revisi, dan pengembangan website bersama Frametech."
            />
            <CTA
                title="Siap Tampil Lebih Profesional Secara Online?"
                description="Mulai dari inspirasi portofolio yang kamu sukai, lalu biarkan kami bantu mewujudkan website yang paling sesuai dengan kebutuhan bisnismu."
                theme="brand"
            />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
