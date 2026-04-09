export type PageSeo = {
    title: string;
    description: string;
    canonical: string;
    keywords: string[];
    ogImage: string;
    schema: Array<Record<string, unknown>>;
};

export type PublicService = {
    title: string;
    slug?: string;
    description: string;
    iconKey: string;
};

export type CmsService = {
    id?: number | null;
    title: string;
    slug: string;
    description: string;
    iconKey: string;
    sortOrder: number;
    isFeatured: boolean;
    isActive: boolean;
};

export type CmsServiceListItem = Required<CmsService>;

export type ServiceStats = {
    totalServices: number;
    featuredServices: number;
    activeServices: number;
};

export type PublicPricingPlan = {
    name: string;
    summary: string;
    previousPrice?: string | null;
    price?: string | null;
    discount?: string | null;
    note?: string | null;
    cta?: string | null;
    features?: string[];
    iconLetter: string;
    accentTone: 'bronze' | 'silver' | 'gold' | 'blue';
};

export type CmsPricingPlan = {
    id?: number | null;
    name: string;
    slug: string;
    summary: string;
    previousPrice: string;
    price: string;
    discountLabel: string;
    note: string;
    ctaLabel: string;
    featuresText: string;
    iconLetter: string;
    accentTone: 'bronze' | 'silver' | 'gold' | 'blue';
    sortOrder: number;
    isFeatured: boolean;
    isActive: boolean;
};

export type CmsPricingPlanListItem = {
    id: number;
    name: string;
    slug: string;
    summary: string;
    price: string;
    discountLabel: string | null;
    featuresCount: number;
    accentTone: 'bronze' | 'silver' | 'gold' | 'blue';
    sortOrder: number;
    isFeatured: boolean;
    isActive: boolean;
};

export type PricingStats = {
    totalPlans: number;
    featuredPlans: number;
    activePlans: number;
};

export type PublicPortfolioItem = {
    title: string;
    clientName?: string | null;
    industry?: string | null;
    location?: string | null;
    summary?: string;
    liveUrl?: string | null;
    desktopImage: string;
    mobileImage: string;
};

export type CmsPortfolioItem = {
    id?: number | null;
    title: string;
    slug: string;
    clientName: string;
    industry: string;
    location: string;
    summary: string;
    liveUrl: string;
    desktopImageUrl: string;
    mobileImageUrl: string;
    sortOrder: number;
    isFeatured: boolean;
    isPublished: boolean;
};

export type CmsPortfolioItemListItem = {
    id: number;
    title: string;
    slug: string;
    industry: string | null;
    location: string | null;
    liveUrl: string | null;
    sortOrder: number;
    isFeatured: boolean;
    isPublished: boolean;
};

export type PortfolioStats = {
    totalItems: number;
    featuredItems: number;
    publishedItems: number;
};

export type MarketingSharedData = {
    footerServices: string[];
};
