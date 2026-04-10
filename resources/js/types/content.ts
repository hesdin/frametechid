export type PublicTestimonial = {
    name: string;
    role: string;
    quote: string;
    avatar?: string | null;
    rating: number;
};

export type PublicFaqItem = {
    question: string;
    answer: string;
};

export type CmsTestimonial = {
    id?: number | null;
    name: string;
    role: string;
    quote: string;
    avatarUrl: string;
    rating: number;
    sortOrder: number;
    isPublished: boolean;
};

export type CmsTestimonialListItem = Required<CmsTestimonial>;

export type TestimonialStats = {
    totalTestimonials: number;
    publishedTestimonials: number;
    averageRating: number;
};

export type CmsFaqItem = {
    id?: number | null;
    question: string;
    answer: string;
    sortOrder: number;
    isPublished: boolean;
};

export type CmsFaqListItem = Required<CmsFaqItem>;

export type FaqStats = {
    totalFaqs: number;
    publishedFaqs: number;
};

export type LeadStatus = 'new' | 'contacted' | 'qualified' | 'closed';

export type CmsLeadListItem = {
    id: number;
    name: string;
    businessName: string | null;
    phoneNumber: string;
    email: string | null;
    serviceInterest: string | null;
    message: string;
    status: LeadStatus;
    source: string;
    notes: string | null;
    contactedAt: string | null;
    createdAt: string;
};

export type CmsLead = Omit<CmsLeadListItem, 'createdAt'>;

export type LeadStats = {
    totalLeads: number;
    newLeads: number;
    qualifiedLeads: number;
};

export type CmsBlogCategory = {
    id?: number | null;
    name: string;
    slug: string;
    description: string;
    seoTitle: string;
    seoDescription: string;
};

export type CmsBlogCategoryListItem = Required<CmsBlogCategory> & {
    postsCount: number;
};

export type BlogCategoryStats = {
    totalCategories: number;
    usedCategories: number;
};

export type CmsBlogTag = {
    id?: number | null;
    name: string;
    slug: string;
};

export type CmsBlogTagListItem = Required<CmsBlogTag> & {
    postsCount: number;
};

export type BlogTagStats = {
    totalTags: number;
    usedTags: number;
};

export type CmsMediaAsset = {
    id?: number | null;
    title: string;
    altText: string;
    url?: string | null;
    mimeType?: string | null;
    fileSize?: number | null;
};

export type CmsMediaAssetListItem = {
    id: number;
    title: string | null;
    altText: string | null;
    filePath: string;
    url: string;
    mimeType: string | null;
    fileSize: number | null;
    createdAt: string;
};

export type MediaStats = {
    totalAssets: number;
    imagesCount: number;
};

export type SelectOption = {
    id: number;
    label: string;
};
