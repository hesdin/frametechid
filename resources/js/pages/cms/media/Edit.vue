<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import MediaAssetController from '@/actions/App/Http/Controllers/Cms/MediaAssetController';
import MediaAssetEditor from '@/components/media/MediaAssetEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsMediaAsset } from '@/types';

const props = defineProps<{ mediaAsset: CmsMediaAsset }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Media Library', href: MediaAssetController.index() },
    { title: props.mediaAsset.title || 'Media', href: MediaAssetController.edit(props.mediaAsset.id ?? 0) },
];
</script>

<template>
    <Head title="Edit Media" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <MediaAssetEditor :media-asset="mediaAsset" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="MediaAssetController.index().url" />
        </div>
    </AppLayout>
</template>
