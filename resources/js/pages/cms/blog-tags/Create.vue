<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import BlogTagController from '@/actions/App/Http/Controllers/Cms/BlogTagController';
import BlogTagEditor from '@/components/blog/BlogTagEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsBlogTag } from '@/types';

defineProps<{ tag: CmsBlogTag }>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Blog Tags', href: BlogTagController.index() },
    { title: 'Tag Baru', href: BlogTagController.create() },
];
</script>

<template>
    <Head title="Tag Blog Baru" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <BlogTagEditor :tag="tag" mode="create" :flash-message="page.props.flash?.success" :cancel-href="BlogTagController.index().url" />
        </div>
    </AppLayout>
</template>
