<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import TestimonialController from '@/actions/App/Http/Controllers/Cms/TestimonialController';
import TestimonialEditor from '@/components/marketing/TestimonialEditor.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsTestimonial } from '@/types';

const props = defineProps<{ testimonial: CmsTestimonial }>();
const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Testimonials', href: TestimonialController.index() },
    { title: props.testimonial.name, href: TestimonialController.edit(props.testimonial.id ?? 0) },
];
</script>

<template>
    <Head :title="`Edit: ${testimonial.name}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <TestimonialEditor :testimonial="testimonial" mode="edit" :flash-message="page.props.flash?.success" :cancel-href="TestimonialController.index().url" />
        </div>
    </AppLayout>
</template>
