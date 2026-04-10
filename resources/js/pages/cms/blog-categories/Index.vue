<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { MessagesSquare, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import BlogCategoryController from '@/actions/App/Http/Controllers/Cms/BlogCategoryController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BlogCategoryStats, BreadcrumbItem, CmsBlogCategoryListItem } from '@/types';

defineProps<{
    stats: BlogCategoryStats;
    categories: CmsBlogCategoryListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Blog Categories', href: BlogCategoryController.index() },
];

function destroyCategory(category: CmsBlogCategoryListItem): void {
    if (!window.confirm(`Hapus kategori "${category.name}"?`)) {
        return;
    }

    router.delete(BlogCategoryController.destroy(category.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Blog Categories" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Blog Categories" description="Kelola kategori untuk struktur artikel dan landing SEO yang lebih rapi." />
                <Button as-child>
                    <Link :href="BlogCategoryController.create()">
                        <PenBox class="size-4" />
                        Tambah kategori
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total kategori</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalCategories }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Dipakai artikel</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.usedCategories }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar kategori</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="categories.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <MessagesSquare class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada kategori.</p>
                            <p class="text-sm text-muted-foreground">Kategori membantu mengelompokkan artikel berdasarkan intent pencarian.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="category in categories" :key="category.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ category.name }}</h3>
                                    <p class="text-sm text-muted-foreground">Slug: {{ category.slug }}</p>
                                </div>
                                <p class="line-clamp-2 max-w-3xl text-sm text-muted-foreground">{{ category.description }}</p>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-muted-foreground">
                                    <span>Artikel: {{ category.postsCount }}</span>
                                    <span>{{ category.seoTitle ? 'SEO title tersedia' : 'SEO title kosong' }}</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="BlogCategoryController.edit(category.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyCategory(category)">
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
