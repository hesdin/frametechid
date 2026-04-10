<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import BlogCategoryController from '@/actions/App/Http/Controllers/Cms/BlogCategoryController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsBlogCategory } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    category: CmsBlogCategory;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
    description: props.category.description,
    seo_title: props.category.seoTitle,
    seo_description: props.category.seoDescription,
});

const syncSlugWithName = ref(props.mode === 'create' && props.category.slug.length === 0);
const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-28 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

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
            ? BlogCategoryController.store()
            : BlogCategoryController.update(props.category.id ?? 0);

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
                    <CardTitle>Detail kategori blog</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="name">Nama kategori</Label>
                        <Input id="name" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="slug">Slug</Label>
                        <Input id="slug" v-model="form.slug" />
                        <InputError :message="form.errors.slug" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="description">Deskripsi</Label>
                        <textarea id="description" v-model="form.description" :class="textareaClass" rows="5" />
                        <InputError :message="form.errors.description" />
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>SEO kategori</CardTitle>
                </CardHeader>
                <CardContent class="space-y-5 p-6">
                    <div class="grid gap-2">
                        <Label for="seo_title">SEO title</Label>
                        <Input id="seo_title" v-model="form.seo_title" />
                        <InputError :message="form.errors.seo_title" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="seo_description">Meta description</Label>
                        <textarea id="seo_description" v-model="form.seo_description" :class="textareaClass" rows="4" />
                        <InputError :message="form.errors.seo_description" />
                    </div>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan kategori' : 'Update kategori' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Kategori membantu struktur konten blog dan bisa dipakai untuk target keyword yang lebih spesifik."
                variant="small"
            />
        </div>
    </div>
</template>
