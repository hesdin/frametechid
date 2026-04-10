<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { PhoneCall, SquarePen, Trash2 } from 'lucide-vue-next';
import LeadController from '@/actions/App/Http/Controllers/Cms/LeadController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem, CmsLeadListItem, LeadStats, LeadStatus } from '@/types';

defineProps<{
    stats: LeadStats;
    leads: CmsLeadListItem[];
    statusOptions: LeadStatus[];
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: dashboard() },
    { title: 'Leads Inbox', href: LeadController.index() },
];

function destroyLead(lead: CmsLeadListItem): void {
    if (!window.confirm(`Hapus lead "${lead.name}"?`)) {
        return;
    }

    router.delete(LeadController.destroy(lead.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Leads Inbox" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="rounded-3xl border bg-card p-6 shadow-sm">
                <Heading title="Leads Inbox" description="Semua form brief dari website publik akan masuk ke sini untuk ditindaklanjuti." />
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Total lead</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight">{{ stats.totalLeads }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Lead baru</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-amber-600">{{ stats.newLeads }}</p></CardContent>
                </Card>
                <Card>
                    <CardHeader><CardTitle class="text-sm text-muted-foreground">Qualified</CardTitle></CardHeader>
                    <CardContent class="pt-0"><p class="text-3xl font-semibold tracking-tight text-emerald-600">{{ stats.qualifiedLeads }}</p></CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Daftar lead</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div v-if="leads.length === 0" class="grid place-items-center gap-3 px-6 py-16 text-center">
                        <div class="grid size-14 place-items-center rounded-full bg-muted">
                            <PhoneCall class="size-6 text-muted-foreground" />
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium">Belum ada lead.</p>
                            <p class="text-sm text-muted-foreground">Lead akan masuk otomatis saat pengunjung mengirim brief dari CTA.</p>
                        </div>
                    </div>

                    <div v-else class="divide-y">
                        <div v-for="lead in leads" :key="lead.id" class="flex flex-col gap-5 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
                            <div class="min-w-0 space-y-2">
                                <div class="flex flex-wrap gap-2">
                                    <span class="rounded-full bg-[#eef5fb] px-2.5 py-1 text-xs font-semibold text-[#2177b8]">
                                        {{ lead.status }}
                                    </span>
                                    <span class="text-xs text-muted-foreground">{{ lead.createdAt }}</span>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold tracking-tight">{{ lead.name }}</h3>
                                    <p class="text-sm text-muted-foreground">{{ lead.businessName || lead.serviceInterest || 'Tanpa nama bisnis' }}</p>
                                </div>
                                <p class="line-clamp-2 max-w-3xl text-sm text-muted-foreground">{{ lead.message }}</p>
                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-muted-foreground">
                                    <span>{{ lead.phoneNumber }}</span>
                                    <span v-if="lead.email">{{ lead.email }}</span>
                                    <span v-if="lead.serviceInterest">{{ lead.serviceInterest }}</span>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <Button variant="outline" as-child>
                                    <Link :href="LeadController.edit(lead.id)">
                                        <SquarePen class="size-4" />
                                        Tindak lanjuti
                                    </Link>
                                </Button>
                                <Button variant="destructive" @click="destroyLead(lead)">
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
