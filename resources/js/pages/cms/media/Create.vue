<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import MediaAssetController from '@/actions/App/Http/Controllers/Cms/MediaAssetController';
import MediaAssetEditor from '@/components/media/MediaAssetEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsMediaAsset } from '@/types';

defineProps<{ mediaAsset: CmsMediaAsset }>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Media Library', href: MediaAssetController.index() },
    { title: 'Upload Baru', href: MediaAssetController.create() },
];
</script>

<template>
    <Head title="Upload Media" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <MediaAssetEditor :media-asset="mediaAsset" mode="create" :flash-message="page.props.flash?.success" :cancel-href="MediaAssetController.index().url" />
        </div>
    </AppLayout>
</template>
