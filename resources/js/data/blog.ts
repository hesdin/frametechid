export type BlogPost = {
  slug: string;
  title: string;
  date: string;
  image: string;
  excerpt: string;
  author: string;
  authorRole: string;
  tags: string[];
}

export const blogPosts: BlogPost[] = [
  {
    slug: 'pembuatan-website-umkm-cara-bisnis-lokal-scale-up-dan-perluas-market-di-2026',
    title: 'Pembuatan Website UMKM: Cara Bisnis Lokal Scale Up dan Perluas Market di 2026',
    date: 'December 4, 2025',
    image: 'https://images.unsplash.com/photo-1556740749-887f6717d7e4?auto=format&fit=crop&w=1600&q=80',
    excerpt:
      'Panduan untuk membantu bisnis lokal tampil lebih profesional, menjangkau pasar lebih luas, dan siap scale up lewat website yang tepat.',
    author: 'Sho',
    authorRole: 'Tim Frametech',
    tags: [
      'digital marketing',
      'pembuatan website umkm',
      'cara go digital',
      'strategi UMKM',
      'website bisnis lokal',
      'website umkm',
    ],
  },
];

export const findBlogPost = (slug: string): BlogPost | undefined => {
  return blogPosts.find((post) => post.slug === slug);
};
