<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { CircleHelp, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import FaqItemController from '@/actions/App/Http/Controllers/Cms/FaqItemController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsFaqListItem, FaqStats } from '@/types';

defineProps<{
    stats: FaqStats;
    faqItems: CmsFaqListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'FAQ', href: FaqItemController.index() },
];

function destroyFaq(faqItem: CmsFaqListItem): void {
    if (!window.confirm(`Hapus FAQ "${faqItem.question}"?`)) {
        return;
    }

    router.delete(FaqItemController.destroy(faqItem.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="FAQ" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="FAQ CMS" description="Kelola pertanyaan yang muncul di landing page dan schema FAQ SEO." />
                <Button as-child>
                    <Link :href="FaqItemController.create()">
                        <PenBox class="size-4" />
                        Tambah FAQ
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total FAQ</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalFaqs }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Published</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.publishedFaqs }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar FAQ</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="faqItems.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <CircleHelp class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada FAQ.</p>
                            <p class="text-sm text-muted-foreground">Tambahkan pertanyaan yang paling sering ditanyakan calon klien.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="faqItem in faqItems" :key="faqItem.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <span :class="faqItem.isPublished ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-100 text-zinc-700'" class="rounded-full px-2.5 py-1 text-xs font-semibold">
                                        {{ faqItem.isPublished ? 'Published' : 'Draft' }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ faqItem.question }}</h3>
                                    <p class="line-clamp-2 max-w-3xl text-sm text-muted-foreground">{{ faqItem.answer }}</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="FaqItemController.edit(faqItem.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyFaq(faqItem)">
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
