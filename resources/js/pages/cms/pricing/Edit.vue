<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import PricingPlanController from '@/actions/App/Http/Controllers/Cms/PricingPlanController';
import PricingPlanEditor from '@/components/marketing/PricingPlanEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsPricingPlan } from '@/types';

const props = defineProps<{ plan: CmsPricingPlan }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Pricing Plans', href: PricingPlanController.index() },
    { title: props.plan.name, href: PricingPlanController.edit(props.plan.id ?? 0) },
];
</script>

<template>
    <Head :title="`Edit: ${plan.name}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <PricingPlanEditor :plan="plan" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="PricingPlanController.index().url" />
        </div>
    </AppLayout>
</template>
