<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import ServiceEditor from '@/components/marketing/ServiceEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsService } from '@/types';

const props = defineProps<{ service: CmsService }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Manage Services', href: ServiceController.index() },
    { title: props.service.title, href: ServiceController.edit(props.service.id ?? 0) },
];
</script>

<template>
    <Head :title="`Edit: ${service.title}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <ServiceEditor :service="service" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="ServiceController.index().url" />
        </div>
    </AppLayout>
</template>
