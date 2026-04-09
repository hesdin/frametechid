<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { BriefcaseBusiness, PenBox, SquarePen, Trash2 } from 'lucide-vue-next';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsServiceListItem, ServiceStats } from '@/types';

defineProps<{
    stats: ServiceStats;
    services: CmsServiceListItem[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Manage Services', href: ServiceController.index() },
];

function destroyService(service: CmsServiceListItem): void {
    if (!window.confirm(`Hapus layanan "${service.title}"?`)) {
        return;
    }

    router.delete(ServiceController.destroy(service.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Manage Services" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="flex flex-col gap-4 rounded-3xl border bg-card p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
                <Heading title="Services CMS" description="Kelola layanan utama yang tampil di halaman website dan footer." />
                <Button as-child>
                    <Link :href="ServiceController.create()">
                        <PenBox class="size-4" />
                        Tambah layanan
                    </Link>
                </Button>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total layanan</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalServices }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Featured</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-sky-600">{{ stats.featuredServices }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Aktif</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.activeServices }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar layanan</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="services.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <BriefcaseBusiness class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada layanan.</p>
                            <p class="text-sm text-muted-foreground">Tambahkan layanan utama agar halaman publik lebih relevan dan lebih kaya keyword.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="service in services" :key="service.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <span v-if="service.isFeatured" class="rounded-full bg-sky-100 px-2.5 py-1 text-xs font-semibold text-sky-700">Featured</span>
                                    <span :class="service.isActive ? 'bg-emerald-100 text-emerald-700' : 'bg-zinc-100 text-zinc-700'" class="rounded-full px-2.5 py-1 text-xs font-semibold">
                                        {{ service.isActive ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ service.title }}</h3>
                                    <p class="line-clamp-2 max-w-3xl text-sm text-muted-foreground">{{ service.description }}</p>
                                </div>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-muted-foreground">
                                    <span>Slug: {{ service.slug }}</span>
                                    <span>Ikon: {{ service.iconKey }}</span>
                                    <span>Urutan: {{ service.sortOrder }}</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="ServiceController.edit(service.id)">
                                        <SquarePen class="size-4" />
                                        Edit
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyService(service)">
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
