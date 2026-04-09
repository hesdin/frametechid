<script setup lang="ts">
import { CheckCircle2 } from 'lucide-vue-next';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';

defineProps<{
    message?: string | null;
}>();
</script>

<template>
    <Alert
        v-if="message"
        class="border-emerald-200 bg-emerald-50 text-emerald-900 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-100"
    >
        <CheckCircle2 class="size-4" />
        <AlertTitle>Tersimpan</AlertTitle>
        <AlertDescription>{{ message }}</AlertDescription>
    </Alert>
</template>
