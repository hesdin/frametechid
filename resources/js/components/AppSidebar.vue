<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    FilePenLine,
    FolderGit2,
    LayoutGrid,
    Layers3,
    PackageSearch,
    PanelsTopLeft,
    Settings2,
} from 'lucide-vue-next';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import PricingPlanController from '@/actions/App/Http/Controllers/Cms/PricingPlanController';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
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
