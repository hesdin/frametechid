<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import CTA from '@/components/landing/CTA.vue';
import Faq from '@/components/landing/Faq.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import PricingHero from '@/components/landing/PricingHero.vue';
import PricingPlans from '@/components/landing/PricingPlans.vue';
import ProcessSteps from '@/components/landing/ProcessSteps.vue';
import LandingLayout from '@/layouts/LandingLayout.vue';
</script>

<template>
    <Head title="Paket & Harga | Frametech">
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
        <Navbar current-page="pricing" theme="brand" />
        <main>
            <PricingHero />
            <PricingPlans />
            <ProcessSteps section-id="proses" theme="brand" />
            <Faq />
            <CTA
                title="Siap Tampil Lebih Profesional Secara Online?"
                description="Mulai dari paket yang paling sesuai, lalu biarkan kami membantu bisnismu tampil lebih rapi, kredibel, dan siap berkembang."
                theme="brand"
            />
        </main>
        <Footer theme="brand" />
    </LandingLayout>
</template>
