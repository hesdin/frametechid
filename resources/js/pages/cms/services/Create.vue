<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import ServiceEditor from '@/components/marketing/ServiceEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsService } from '@/types';

defineProps<{ service: CmsService }>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Manage Services', href: ServiceController.index() },
    { title: 'Layanan Baru', href: ServiceController.create() },
];
</script>

<template>
    <Head title="Layanan Baru" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <ServiceEditor :service="service" mode="create" :flash-message="page.props.flash?.success" :cancel-href="ServiceController.index().url" />
        </div>
    </AppLayout>
</template>
