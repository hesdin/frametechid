<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BusinessTypes from '@/components/landing/BusinessTypes.vue';
import CTA from '@/components/landing/CTA.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import ProcessSteps from '@/components/landing/ProcessSteps.vue';
import ServicesGrid from '@/components/landing/ServicesGrid.vue';
import ServicesHero from '@/components/landing/ServicesHero.vue';
import ServicesPricing from '@/components/landing/ServicesPricing.vue';
import WhyChoose from '@/components/landing/WhyChoose.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
</script>

<template>
    <Head title="Layanan | Frametech">
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
        <Navbar current-page="services" theme="brand" />
        <main>
            <ServicesHero />
            <ServicesGrid />
            <WhyChoose
                section-id="tentang"
                title="Kenapa Jasa Pembuatan Website di Frametech"
                description="Kami merancang website yang bukan hanya menarik secara visual, tetapi juga jelas secara pesan, nyaman digunakan, dan siap mendukung pertumbuhan bisnis secara nyata."
                theme="brand"
            />
            <ProcessSteps section-id="proses" theme="brand" />
            <BusinessTypes
                section-id="portfolio"
                background-class="bg-[linear-gradient(180deg,#ffffff_0%,#eef7fd_100%)]"
                button-href="#contact"
                accent-theme="brand"
            />
            <ServicesPricing />
            <CTA theme="brand" />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
