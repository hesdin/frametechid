<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Copy, ImagePlus, SquarePen, Trash2 } from 'lucide-vue-next';
import MediaAssetController from '@/actions/App/Http/Controllers/Cms/MediaAssetController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsMediaAssetListItem, MediaStats } from '@/types';

defineProps<{
    stats: MediaStats;
    mediaAssets: CmsMediaAssetListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Media Library', href: MediaAssetController.index() },
];

function destroyMedia(mediaAsset: CmsMediaAssetListItem): void {
    if (!window.confirm(`Hapus asset "${mediaAsset.title || mediaAsset.filePath}"?`)) {
        return;
    }

    router.delete(MediaAssetController.destroy(mediaAsset.id).url, {
        preserveScroll: true,
    });
}

function copyUrl(url: string): void {
    if (!navigator.clipboard) {
        return;
    }

    void navigator.clipboard.writeText(url);
}
</script>

<template>
    <Head title="Media Library" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Media Library" description="Upload asset sekali lalu pakai URL-nya untuk blog, layanan, dan pengaturan situs." />
                <Button as-child>
                    <Link :href="MediaAssetController.create()">
                        <ImagePlus class="size-4" />
                        Upload media
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total asset</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalAssets }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Gambar</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.imagesCount }}</p></CardContent>
                </Card>
            </div>

            <div v-if="mediaAssets.length === 0" class="grid place-items-center gap-3 rounded-3xl border bg-card px-6 py-16 text-center shadow-sm">
                <div class="grid size-14 place-items-center rounded-full bg-muted">
                    <ImagePlus class="size-6 text-muted-foreground" />
                </div>
                <div class="space-y-1">
                    <p class="font-medium">Belum ada asset.</p>
                    <p class="text-sm text-muted-foreground">Mulai upload banner, logo tambahan, atau cover blog ke library ini.</p>
                </div>
            </div>

            <div v-else class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                <Card v-for="mediaAsset in mediaAssets" :key="mediaAsset.id" class="gap-0 overflow-hidden py-0">
                    <CardContent class="space-y-4 p-4">
                        <div class="overflow-hidden rounded-2xl border bg-muted/20">
                            <img :src="mediaAsset.url" :alt="mediaAsset.altText || mediaAsset.title || mediaAsset.filePath" class="h-52 w-full object-cover" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-semibold">{{ mediaAsset.title || mediaAsset.filePath }}</p>
                            <p class="text-sm text-muted-foreground">{{ mediaAsset.createdAt }}</p>
                        </div>
                        <div class="grid gap-2 text-sm text-muted-foreground">
                            <p class="truncate">{{ mediaAsset.url }}</p>
                            <p v-if="mediaAsset.mimeType">Tipe: {{ mediaAsset.mimeType }}</p>
                        </div>
                        <div class="flex gap-2">
                            <Button variant="outline" size="sm" @click="copyUrl(mediaAsset.url)">
                                <Copy class="size-4" />
                                Copy URL
                            </Button>
                            <Button variant="outline" size="sm" as-child>
                                <Link :href="MediaAssetController.edit(mediaAsset.id)">
                                    <SquarePen class="size-4" />
                                    Edit
                                </Link>
                            </Button>
                            <Button variant="destructive" size="sm" @click="destroyMedia(mediaAsset)">
                                <Trash2 class="size-4" />
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
