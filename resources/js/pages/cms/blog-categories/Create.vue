<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import BlogCategoryController from '@/actions/App/Http/Controllers/Cms/BlogCategoryController';
import BlogCategoryEditor from '@/components/blog/BlogCategoryEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsBlogCategory } from '@/types';

defineProps<{ category: CmsBlogCategory }>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Blog Categories', href: BlogCategoryController.index() },
    { title: 'Kategori Baru', href: BlogCategoryController.create() },
];
</script>

<template>
    <Head title="Kategori Blog Baru" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <BlogCategoryEditor :category="category" mode="create" :flash-message="page.props.flash?.success" :cancel-href="BlogCategoryController.index().url" />
        </div>
    </AppLayout>
</template>
