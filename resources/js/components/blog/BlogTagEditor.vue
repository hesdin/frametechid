<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import BlogTagController from '@/actions/App/Http/Controllers/Cms/BlogTagController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsBlogTag } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    tag: CmsBlogTag;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    name: props.tag.name,
    slug: props.tag.slug,
});

const syncSlugWithName = ref(props.mode === 'create' && props.tag.slug.length === 0);

watch(
    () => form.name,
    (value: string) => {
        if (!syncSlugWithName.value) {
            return;
        }

        form.slug = slugify(value);
    },
);

function slugify(value: string): string {
    return value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
}

function submit(): void {
    const action =
        props.mode === 'create'
            ? BlogTagController.store()
            : BlogTagController.update(props.tag.id ?? 0);

    form.submit(action, {
        preserveScroll: true,
    });
}
</script>

<template>
    <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]">
        <div class="space-y-6">
            <FlashMessage :message="flashMessage" />

            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Detail tag blog</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="name">Nama tag</Label>
                        <Input id="name" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="slug">Slug</Label>
                        <Input id="slug" v-model="form.slug" />
                        <InputError :message="form.errors.slug" />
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan tag' : 'Update tag' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Tag membantu menghubungkan topik artikel yang mirip seperti SEO, Makassar, atau company profile."
                variant="small"
            />
        </div>
    </div>
</template>
