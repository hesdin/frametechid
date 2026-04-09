<script setup lang="ts">
import { useSiteSettings } from '@/composables/useSiteSettings';

const { site } = useSiteSettings();
</script>

<template>
    <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-white p-1">
        <img :src="site.logoUrl" :alt="site.siteName" class="size-6 object-contain" />
    </div>
    <div class="ml-1 grid flex-1 text-left text-sm">
        <span class="mb-0.5 truncate leading-tight font-semibold"
            >{{ site.siteName }}</span
        >
    </div>
</template>
