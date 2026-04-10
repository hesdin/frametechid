<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import {
    ArrowRight,
    CircleHelp,
    Layers3,
    MessageSquareQuote,
    Newspaper,
    PackageSearch,
    PanelsTopLeft,
    PenSquare,
    PhoneCall,
    Users,
} from 'lucide-vue-next';
import FaqItemController from '@/actions/App/Http/Controllers/Cms/FaqItemController';
import LeadController from '@/actions/App/Http/Controllers/Cms/LeadController';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import PricingPlanController from '@/actions/App/Http/Controllers/Cms/PricingPlanController';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import TestimonialController from '@/actions/App/Http/Controllers/Cms/TestimonialController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import type { PostStats } from '@/types/blog';

defineProps<{
    stats: PostStats;
    contentStats: {
        services: number;
        pricingPlans: number;
        portfolioItems: number;
        testimonials: number;
        faqs: number;
        newLeads: number;
    };
    visitorStats: {
        totalUniqueVisitors: number;
        uniqueVisitorsToday: number;
    };
    recentPosts: Array<{
        id: number;
        title: string;
        status: 'draft' | 'published';
        author: string;
        updatedAt: string;
    }>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
];

const page = usePage();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
            <FlashMessage :message="page.props.flash?.success" />

            <div class="rounded-3xl border bg-card p-6 shadow-sm">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                    <Heading
                        title="CMS Dashboard"
                        description="Pusat kerja cepat untuk mengelola artikel blog dan melihat status konten terbaru."
                    />
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <Button variant="outline" as-child>
                            <Link :href="ServiceController.index()">
                                <Layers3 class="size-4" />
                                Manage services
                            </Link>
                        </Button>
                        <Button variant="outline" as-child>
                            <Link :href="PostController.index()">
                                <Newspaper class="size-4" />
                                Manage blog
                            </Link>
                        </Button>
                        <Button as-child>
                            <Link :href="PostController.create()">
                                <PenSquare class="size-4" />
                                Buat artikel
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3 xl:grid-cols-5">
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Total artikel
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight">
                            {{ stats.totalPosts }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Published
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-emerald-600">
                            {{ stats.publishedPosts }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Draft
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-amber-600">
                            {{ stats.draftPosts }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Pengunjung unik
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="flex items-center gap-2 text-3xl font-semibold tracking-tight text-sky-600">
                            <Users class="size-5" />
                            {{ visitorStats.totalUniqueVisitors }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Pengunjung hari ini
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-cyan-600">
                            {{ visitorStats.uniqueVisitorsToday }}
                        </p>
                    </CardContent>
                </Card>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Layanan aktif di CMS
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-sky-600">
                            {{ contentStats.services }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Paket harga
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-amber-600">
                            {{ contentStats.pricingPlans }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Item portofolio
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-violet-600">
                            {{ contentStats.portfolioItems }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Testimoni
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-rose-600">
                            {{ contentStats.testimonials }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            FAQ
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-cyan-600">
                            {{ contentStats.faqs }}
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="space-y-1">
                        <CardTitle class="text-sm font-medium text-muted-foreground">
                            Leads baru
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="pt-0">
                        <p class="text-3xl font-semibold tracking-tight text-emerald-600">
                            {{ contentStats.newLeads }}
                        </p>
                    </CardContent>
                </Card>
            </div>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Shortcut konten marketing</CardTitle>
                </CardHeader>
                <CardContent class="grid gap-4 p-6 md:grid-cols-2 xl:grid-cols-6">
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="ServiceController.index()">
                            Manage services
                            <Layers3 class="size-4" />
                        </Link>
                    </Button>
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="PricingPlanController.index()">
                            Manage pricing
                            <PackageSearch class="size-4" />
                        </Link>
                    </Button>
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="PortfolioItemController.index()">
                            Manage portfolio
                            <PanelsTopLeft class="size-4" />
                        </Link>
                    </Button>
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="TestimonialController.index()">
                            Testimonials
                            <MessageSquareQuote class="size-4" />
                        </Link>
                    </Button>
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="FaqItemController.index()">
                            FAQ
                            <CircleHelp class="size-4" />
                        </Link>
                    </Button>
                    <Button variant="outline" class="justify-between" as-child>
                        <Link :href="LeadController.index()">
                            Leads inbox
                            <PhoneCall class="size-4" />
                        </Link>
                    </Button>
                </CardContent>
            </Card>

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/20">
                    <CardTitle>Aktivitas artikel terbaru</CardTitle>
                </CardHeader>
                <CardContent class="p-0">
                    <div
                        v-if="recentPosts.length === 0"
                        class="px-6 py-16 text-center text-sm text-muted-foreground"
                    >
                        Belum ada artikel. Mulai dari satu draft baru untuk mengisi blog.
                    </div>
                    <div v-else class="divide-y">
                        <div
                            v-for="post in recentPosts"
                            :key="post.id"
                            class="flex flex-col gap-4 px-6 py-5 md:flex-row md:items-center md:justify-between"
                        >
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold"
                                        :class="
                                            post.status === 'published'
                                                ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300'
                                                : 'bg-amber-100 text-amber-700 dark:bg-amber-950/40 dark:text-amber-300'
                                        "
                                    >
                                        {{ post.status === 'published' ? 'Published' : 'Draft' }}
                                    </span>
                                    <span class="text-xs text-muted-foreground">
                                        {{ post.updatedAt }}
                                    </span>
                                </div>
                                <p class="text-lg font-semibold tracking-tight">
                                    {{ post.title }}
                                </p>
                                <p class="text-sm text-muted-foreground">
                                    {{ post.author }}
                                </p>
                            </div>

                            <Button variant="ghost" as-child>
                                <Link :href="PostController.edit(post.id)">
                                    Buka editor
                                    <ArrowRight class="size-4" />
                                </Link>
                            </Button>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
