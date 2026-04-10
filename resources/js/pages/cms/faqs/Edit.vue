<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import FaqItemController from '@/actions/App/Http/Controllers/Cms/FaqItemController';
import FaqItemEditor from '@/components/marketing/FaqItemEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsFaqItem } from '@/types';

const props = defineProps<{ faqItem: CmsFaqItem }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'FAQ', href: FaqItemController.index() },
    { title: props.faqItem.question, href: FaqItemController.edit(props.faqItem.id ?? 0) },
];
</script>

<template>
    <Head :title="`Edit FAQ`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FaqItemEditor :faq-item="faqItem" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="FaqItemController.index().url" />
        </div>
    </AppLayout>
</template>
