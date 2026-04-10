export type BusinessTypesSlide = {
    title: string;
    imageUrl: string;
};

export type SiteSettings = {
    siteName: string;
    companyDescription: string;
    phoneNumber: string;
    whatsappNumber: string;
    whatsappUrl: string;
    email: string | null;
    address: string | null;
    businessHours: string | null;
    instagramUrl: string | null;
    facebookUrl: string | null;
    linkedinUrl: string | null;
    tiktokUrl: string | null;
    youtubeUrl: string | null;
    copyrightName: string | null;
    seoTitle: string | null;
    seoDescription: string | null;
    seoKeywords: string | null;
    seoLocality: string | null;
    seoRegion: string | null;
    seoFocusKeyword: string | null;
    logoUrl: string;
    faviconUrl: string;
    businessTypesSlides: BusinessTypesSlide[];
};

export type EditableSiteSettings = Omit<SiteSettings, 'whatsappUrl'>;
