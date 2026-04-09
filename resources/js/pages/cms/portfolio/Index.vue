<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { FolderOpenDot, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsPortfolioItemListItem, PortfolioStats } from '@/types';

defineProps<{
    stats: PortfolioStats;
    items: CmsPortfolioItemListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Portfolio', href: PortfolioItemController.index() },
];

function destroyItem(item: CmsPortfolioItemListItem): void {
    if (!window.confirm(`Hapus portofolio "${item.title}"?`)) {
        return;
    }

    router.delete(PortfolioItemController.destroy(item.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Portfolio CMS" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Portfolio CMS" description="Kelola project yang tampil di landing dan halaman portofolio." />
                <Button as-child>
                    <Link :href="PortfolioItemController.create()">
                        <PenBox class="size-4" />
                        Tambah project
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total project</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalItems }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Featured</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-sky-600">{{ stats.featuredItems }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Published</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.publishedItems }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20"><CardTitle>Daftar project</CardTitle></CardHeader>
                <CardContent class="p-0">
                    <div v-if="items.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <FolderOpenDot class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada project.</p>
                            <p class="text-sm text-muted-foreground">Portofolio yang rapi memperkuat trust dan membantu keyword pencarian jasa website atau aplikasi di Makassar.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="item in items" :key="item.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <span v-if="item.isFeatured" class="rounded-full bg-sky-100 px-2.5 py-1 text-xs font-semibold text-sky-700">Featured</span>
                                    <span :class="item.isPublished ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-100 text-zinc-700'" class="rounded-full px-2.5 py-1 text-xs font-semibold">
                                        {{ item.isPublished ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ item.title }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ item.industry ?? 'Tanpa industri' }} • {{ item.location ?? 'Tanpa lokasi' }}</p>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-muted-foreground">
                                    <span>Slug: {{ item.slug }}</span>
                                    <span>Urutan: {{ item.sortOrder }}</span>
                                    <span v-if="item.liveUrl">Live URL tersedia</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="PortfolioItemController.edit(item.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyItem(item)">
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
