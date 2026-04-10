<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Boxes, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import BlogTagController from '@/actions/App/Http/Controllers/Cms/BlogTagController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BlogTagStats, BreadcrumbItem, CmsBlogTagListItem } from '@/types';

defineProps<{
    stats: BlogTagStats;
    tags: CmsBlogTagListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Blog Tags', href: BlogTagController.index() },
];

function destroyTag(tag: CmsBlogTagListItem): void {
    if (!window.confirm(`Hapus tag "${tag.name}"?`)) {
        return;
    }

    router.delete(BlogTagController.destroy(tag.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Blog Tags" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Blog Tags" description="Kelola tag untuk topik lintas kategori seperti SEO, Makassar, atau company profile." />
                <Button as-child>
                    <Link :href="BlogTagController.create()">
                        <PenBox class="size-4" />
                        Tambah tag
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total tag</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalTags }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Dipakai artikel</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.usedTags }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar tag</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="tags.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <Boxes class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada tag.</p>
                            <p class="text-sm text-muted-foreground">Tag memudahkan pengelompokan topik lintas kategori.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="tag in tags" :key="tag.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ tag.name }}</h3>
                                    <p class="text-sm text-muted-foreground">Slug: {{ tag.slug }}</p>
                                </div>
                                <p class="text-sm text-muted-foreground">Dipakai di {{ tag.postsCount }} artikel</p>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="BlogTagController.edit(tag.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyTag(tag)">
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
