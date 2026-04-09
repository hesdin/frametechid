<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import PortfolioItemController from '@/actions/App/Http/Controllers/Cms/PortfolioItemController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsPortfolioItem } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    item: CmsPortfolioItem;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    title: props.item.title,
    slug: props.item.slug,
    client_name: props.item.clientName,
    industry: props.item.industry,
    location: props.item.location,
    summary: props.item.summary,
    live_url: props.item.liveUrl,
    desktop_image_url: props.item.desktopImageUrl,
    mobile_image_url: props.item.mobileImageUrl,
    sort_order: props.item.sortOrder,
    is_featured: props.item.isFeatured,
    is_published: props.item.isPublished,
});

const syncSlugWithTitle = ref(props.mode === 'create' && props.item.slug.length === 0);
const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

watch(
    () => form.title,
    (value: string) => {
        if (!syncSlugWithTitle.value) {
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

function regenerateSlug(): void {
    syncSlugWithTitle.value = true;
    form.slug = slugify(form.title);
}

function handleSlugInput(value: string | number): void {
    syncSlugWithTitle.value = false;
    form.slug = slugify(String(value));
}

function submit(): void {
    const action =
        props.mode === 'create'
            ? PortfolioItemController.store()
            : PortfolioItemController.update(props.item.id ?? 0);

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
                    <CardTitle>Detail portofolio</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="title">Judul project</Label>
                        <Input id="title" v-model="form.title" placeholder="Makassar Booking Suite" />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between gap-3">
                            <Label for="slug">Slug</Label>
                            <button type="button" class="text-xs font-medium text-primary transition hover:opacity-80" @click="regenerateSlug">
                                Generate dari judul
                            </button>
                        </div>
                        <Input id="slug" :model-value="form.slug" placeholder="makassar-booking-suite" @update:model-value="handleSlugInput" />
                        <InputError :message="form.errors.slug" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="client_name">Nama klien</Label>
                            <Input id="client_name" v-model="form.client_name" />
                            <InputError :message="form.errors.client_name" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="industry">Industri</Label>
                            <Input id="industry" v-model="form.industry" placeholder="Aplikasi Web" />
                            <InputError :message="form.errors.industry" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="location">Lokasi</Label>
                            <Input id="location" v-model="form.location" placeholder="Makassar" />
                            <InputError :message="form.errors.location" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="live_url">URL project</Label>
                            <Input id="live_url" v-model="form.live_url" placeholder="https://example.com/project" />
                            <InputError :message="form.errors.live_url" />
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="summary">Ringkasan project</Label>
                        <textarea id="summary" v-model="form.summary" :class="textareaClass" rows="5" />
                        <InputError :message="form.errors.summary" />
                    </div>

                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <Label for="desktop_image_url">Desktop image URL</Label>
                            <Input id="desktop_image_url" v-model="form.desktop_image_url" />
                            <InputError :message="form.errors.desktop_image_url" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="mobile_image_url">Mobile image URL</Label>
                            <Input id="mobile_image_url" v-model="form.mobile_image_url" />
                            <InputError :message="form.errors.mobile_image_url" />
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Pengaturan tampilan</CardTitle>
                </CardHeader>
                <CardContent class="space-y-5 p-6">
                    <div class="grid gap-2">
                        <Label for="sort_order">Urutan</Label>
                        <Input id="sort_order" v-model="form.sort_order" type="number" min="1" />
                        <InputError :message="form.errors.sort_order" />
                    </div>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_featured" type="checkbox" />
                        Tampilkan sebagai unggulan
                    </label>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_published" type="checkbox" />
                        Tampilkan di halaman publik
                    </label>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan portofolio' : 'Update portofolio' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading title="Catatan" description="Cantumkan industri dan lokasi project agar portofolio lebih relevan untuk pencarian lokal dan meningkatkan kepercayaan calon klien." />
        </div>
    </div>
</template>
