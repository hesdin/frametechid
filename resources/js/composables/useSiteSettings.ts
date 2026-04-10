import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import type { SiteSettings } from '@/types/site';

const fallbackSiteSettings: SiteSettings = {
    siteName: 'Frametech',
    companyDescription:
        'Frametech adalah layanan jasa pembuatan website profesional untuk UMKM dan bisnis lokal.',
    phoneNumber: '08986650404',
    whatsappNumber: '628986650404',
    whatsappUrl: 'https://wa.me/628986650404',
    email: 'hello@frametech.test',
    address: 'Makassar, Sulawesi Selatan',
    businessHours: 'Setiap Hari, 09.00 - 21.00 WITA',
    instagramUrl: null,
    facebookUrl: null,
    linkedinUrl: null,
    tiktokUrl: null,
    youtubeUrl: null,
    copyrightName: 'PT. Global Creative Labs',
    seoTitle: 'Frametech | Jasa Pembuatan Website & Aplikasi Makassar',
    seoDescription:
        'Frametech melayani jasa pembuatan website dan aplikasi untuk bisnis di Makassar.',
    seoKeywords: 'jasa pembuatan aplikasi makassar, jasa website makassar',
    seoLocality: 'Makassar',
    seoRegion: 'Sulawesi Selatan',
    seoFocusKeyword: 'Jasa Pembuatan Aplikasi Makassar',
    logoUrl: '/images/landing/logo-frametech.png',
    faviconUrl: '/favicon.ico',
    businessTypesSlides: [
        {
            title: 'Interior',
            imageUrl:
                'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80',
        },
        {
            title: 'Produk',
            imageUrl:
                'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80',
        },
        {
            title: 'Hospitality',
            imageUrl:
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1600&q=80',
        },
        {
            title: 'Portfolio',
            imageUrl:
                'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80',
        },
        {
            title: 'Company',
            imageUrl:
                'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1600&q=80',
        },
    ],
};

export function useSiteSettings() {
    const page = usePage();

    const site = computed(
        () => (page.props.site as SiteSettings | undefined) ?? fallbackSiteSettings,
    );

    return {
        site,
    };
}
