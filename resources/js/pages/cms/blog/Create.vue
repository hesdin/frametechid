<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import PostEditor from '@/components/blog/PostEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import type { CmsEditablePost } from '@/types/blog';

defineProps<{
    post: CmsEditablePost;
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
    {
        title: 'Artikel Baru',
        href: PostController.create(),
    },
];
</script>

<template>
    <Head title="Artikel Baru" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <PostEditor
                :post="post"
                mode="create"
                :flash-message="page.props.flash?.success"
                :cancel-href="PostController.index().url"
            />
        </div>
    </AppLayout>
</template>
