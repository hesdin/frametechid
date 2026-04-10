<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { MessageSquareQuote, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import TestimonialController from '@/actions/App/Http/Controllers/Cms/TestimonialController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsTestimonialListItem, TestimonialStats } from '@/types';

defineProps<{
    stats: TestimonialStats;
    testimonials: CmsTestimonialListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Testimonials', href: TestimonialController.index() },
];

function destroyTestimonial(testimonial: CmsTestimonialListItem): void {
    if (!window.confirm(`Hapus testimoni "${testimonial.name}"?`)) {
        return;
    }

    router.delete(TestimonialController.destroy(testimonial.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Testimonials" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Testimonials CMS" description="Kelola testimoni klien yang tampil di landing page dan memperkuat trust bisnis." />
                <Button as-child>
                    <Link :href="TestimonialController.create()">
                        <PenBox class="size-4" />
                        Tambah testimoni
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total testimoni</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalTestimonials }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Published</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.publishedTestimonials }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Rating rata-rata</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-amber-600">{{ stats.averageRating }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar testimoni</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="testimonials.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <MessageSquareQuote class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada testimoni.</p>
                            <p class="text-sm text-muted-foreground">Tambahkan social proof agar landing page lebih meyakinkan.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="testimonial in testimonials" :key="testimonial.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <span :class="testimonial.isPublished ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-100 text-zinc-700'" class="rounded-full px-2.5 py-1 text-xs font-semibold">
                                        {{ testimonial.isPublished ? 'Published' : 'Draft' }}
                                    </span>
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                        {{ '★'.repeat(testimonial.rating) }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ testimonial.name }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ testimonial.role }}</p>
                                </div>
                                <p class="line-clamp-2 max-w-3xl text-sm text-muted-foreground">{{ testimonial.quote }}</p>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="TestimonialController.edit(testimonial.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyTestimonial(testimonial)">
                                    <Trash2 class="size-4" />
                                    Hapus
                                </Button>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
