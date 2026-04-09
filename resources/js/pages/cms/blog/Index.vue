<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { FilePenLine, Newspaper, PenBox, Trash2 } from 'lucide-vue-next';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import type { CmsPostListItem, PostStats } from '@/types/blog';

defineProps<{
    stats: PostStats;
    posts: CmsPostListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
    {
        title: 'Manage Blog',
        href: PostController.index(),
    },
];

function destroyPost(post: CmsPostListItem): void {
    if (!window.confirm(`Hapus artikel "${post.title}"?`)) {
        return;
    }

    router.delete(PostController.destroy(post.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Manage Blog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div
                class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between"
            >
                <div class="space-y-2">
                    <Heading
                        title="Blog CMS"
                        description="Kelola artikel, rapikan draft, dan publish konten baru langsung dari dashboard."
                    />
                </div>
                <Button as-child>
                    <Link :href="PostController.create()">
                        <PenBox class="size-4" />
                        Tulis artikel baru
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle
                            class="text-sm font-medium text-muted-foreground"
                        >
                            Total artikel
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight">
                            {{ stats.totalPosts }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle
                            class="text-sm font-medium text-muted-foreground"
                        >
                            Published
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p
                            class="text-3xl font-semibold tracking-tight text-emerald-600"
                        >
                            {{ stats.publishedPosts }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle
                            class="text-sm font-medium text-muted-foreground"
                        >
                            Draft
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p
                            class="text-3xl font-semibold tracking-tight text-amber-600"
                        >
                            {{ stats.draftPosts }}
                        </p>
                    </CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar artikel</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div
                        v-if="posts.length === 0"
                        class="grid place-items-center gap-3 px-6 py-16 text-center"
                    >
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <Newspaper class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada artikel.</p>
                            <p class="text-sm text-muted-foreground">
                                Mulai dari satu draft dulu, lalu publish saat
                                kontennya siap.
                            </p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div
                            v-for="post in posts"
                            :key="post.id"
                            class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between"
                        >
                            <div class="min-w-0 space-y-2">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold"
                                        :class="
                                            post.status === 'published'
                                                ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300'
                                                : 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300'
                                        "
                                    >
                                        {{
                                            post.status === 'published'
                                                ? 'Published'
                                                : 'Draft'
                                        }}
                                    </span>
                                    <span class="text-xs text-muted-foreground">
                                        {{ post.updatedAt }}
                                    </span>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold tracking-tight">
                                        {{ post.title }}
                                    </h3>
                                    <p
                                        class="line-clamp-2 max-w-3xl text-sm text-muted-foreground"
                                    >
                                        {{ post.excerpt }}
                                    </p>
                                </div>
                                <div
                                    class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-muted-foreground"
                                >
                                    <span>Slug: /blog/{{ post.slug }}</span>
                                    <span>Author: {{ post.author }}</span>
                                    <span v-if="post.publishedAt">
                                        Publish: {{ post.publishedAt }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="PostController.edit(post.id)">
                                        <FilePenLine class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button
                                    variant="destructive"
                                    @click="destroyPost(post)"
                                >
                                    <Trash2 class="size-4" />
                                    Hapus
                                </Button>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
