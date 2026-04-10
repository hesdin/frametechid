<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import LeadController from '@/actions/App/Http/Controllers/Cms/LeadController';
import LeadEditor from '@/components/leads/LeadEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsLead, LeadStatus } from '@/types';

const props = defineProps<{
    lead: CmsLead;
    statusOptions: LeadStatus[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Leads Inbox', href: LeadController.index() },
    { title: props.lead.name, href: LeadController.edit(props.lead.id) },
];
</script>

<template>
    <Head :title="`Lead: ${lead.name}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <LeadEditor :lead="lead" :status-options="statusOptions" :flash-message="page.props.flash?.success" :cancel-href="LeadController.index().url" />
        </div>
    </AppLayout>
</template>
