<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    Boxes,
    CircleHelp,
    FilePenLine,
    FolderGit2,
    LayoutGrid,
    Layers3,
    MessageSquareQuote,
    MessagesSquare,
    PackageSearch,
    PanelsTopLeft,
    PhoneCall,
    Settings2,
} from 'lucide-vue-next';
import BlogCategoryController from '@/actions/App/Http/Controllers/Cms/BlogCategoryController';
import BlogTagController from '@/actions/App/Http/Controllers/Cms/BlogTagController';
import FaqItemController from '@/actions/App/Http/Controllers/Cms/FaqItemController';
import LeadController from '@/actions/App/Http/Controllers/Cms/LeadController';
import MediaAssetController from '@/actions/App/Http/Controllers/Cms/MediaAssetController';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import PricingPlanController from '@/actions/App/Http/Controllers/Cms/PricingPlanController';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import TestimonialController from '@/actions/App/Http/Controllers/Cms/TestimonialController';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { edit as editSite } from '@/routes/site-settings';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Manage Blog',
        href: PostController.index(),
        icon: FilePenLine,
        matchSubpaths: true,
    },
    {
        title: 'Manage Services',
        href: ServiceController.index(),
        icon: Layers3,
        matchSubpaths: true,
    },
    {
        title: 'Pricing Plans',
        href: PricingPlanController.index(),
        icon: PackageSearch,
        matchSubpaths: true,
    },
    {
        title: 'Portfolio',
        href: PortfolioItemController.index(),
        icon: PanelsTopLeft,
        matchSubpaths: true,
    },
    {
        title: 'Testimonials',
        href: TestimonialController.index(),
        icon: MessageSquareQuote,
        matchSubpaths: true,
    },
    {
        title: 'FAQ',
        href: FaqItemController.index(),
        icon: CircleHelp,
        matchSubpaths: true,
    },
    {
        title: 'Leads Inbox',
        href: LeadController.index(),
        icon: PhoneCall,
        matchSubpaths: true,
    },
    {
        title: 'Blog Categories',
        href: BlogCategoryController.index(),
        icon: MessagesSquare,
        matchSubpaths: true,
    },
    {
        title: 'Blog Tags',
        href: BlogTagController.index(),
        icon: Boxes,
        matchSubpaths: true,
    },
    {
        title: 'Media Library',
        href: MediaAssetController.index(),
        icon: FolderGit2,
        matchSubpaths: true,
    },
    {
        title: 'Site Settings',
        href: editSite(),
        icon: Settings2,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
