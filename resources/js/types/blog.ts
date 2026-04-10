export type PostStatus = 'draft' | 'published';

export type PostStats = {
    totalPosts: number;
    publishedPosts: number;
    draftPosts: number;
};

export type CmsPostListItem = {
    id: number;
    title: string;
    slug: string;
    excerpt: string;
    status: PostStatus;
    coverImage: string | null;
    publishedAt: string | null;
    updatedAt: string;
    author: string;
    category: string | null;
    tags: string[];
    hasSeo: boolean;
};

export type CmsEditablePost = {
    id?: number;
    title: string;
    slug: string;
    excerpt: string;
    content: string;
    coverImage: string;
    status: PostStatus;
    categoryId: number | null;
    tagIds: number[];
    seoTitle: string;
    seoDescription: string;
    seoKeywords: string;
    publishedAt?: string | null;
    updatedAt?: string | null;
};

export type PublicBlogPost = {
    id: number;
    slug: string;
    title: string;
    excerpt: string;
    coverImage: string | null;
    publishedAt: string | null;
    category: string | null;
    tags: string[];
};

export type PublicBlogDetail = PublicBlogPost & {
    content: string;
    author: string;
};
