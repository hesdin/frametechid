<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import PortfolioItemEditor from '@/components/marketing/PortfolioItemEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsPortfolioItem } from '@/types';

const props = defineProps<{ item: CmsPortfolioItem }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Portfolio', href: PortfolioItemController.index() },
    { title: props.item.title, href: PortfolioItemController.edit(props.item.id ?? 0) },
];
</script>

<template>
    <Head :title="`Edit: ${item.title}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <PortfolioItemEditor :item="item" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="PortfolioItemController.index().url" />
        </div>
    </AppLayout>
</template>
