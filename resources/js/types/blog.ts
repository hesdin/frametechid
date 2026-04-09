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
};

export type CmsEditablePost = {
    id?: number;
    title: string;
    slug: string;
    excerpt: string;
    content: string;
    coverImage: string;
    status: PostStatus;
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
};

export type PublicBlogDetail = PublicBlogPost & {
    content: string;
    author: string;
};
