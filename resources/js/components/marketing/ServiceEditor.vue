<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import ServiceController from '@/actions/App/Http/Controllers/Cms/ServiceController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { serviceIconOptions } from '@/lib/marketing';
import type { CmsService } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    service: CmsService;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    title: props.service.title,
    slug: props.service.slug,
    description: props.service.description,
    icon_key: props.service.iconKey,
    sort_order: props.service.sortOrder,
    is_featured: props.service.isFeatured,
    is_active: props.service.isActive,
});

const syncSlugWithTitle = ref(props.mode === 'create' && props.service.slug.length === 0);
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
            ? ServiceController.store()
            : ServiceController.update(props.service.id ?? 0);

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
                    <CardTitle>Detail layanan</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="title">Nama layanan</Label>
                        <Input id="title" v-model="form.title" placeholder="Jasa Pembuatan Aplikasi Web" />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between gap-3">
                            <Label for="slug">Slug</Label>
                            <button type="button" class="text-xs font-medium text-primary transition hover:opacity-80" @click="regenerateSlug">
                                Generate dari judul
                            </button>
                        </div>
                        <Input id="slug" :model-value="form.slug" placeholder="jasa-pembuatan-aplikasi-web" @update:model-value="handleSlugInput" />
                        <InputError :message="form.errors.slug" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="description">Deskripsi</Label>
                        <textarea id="description" v-model="form.description" :class="textareaClass" rows="5" placeholder="Jelaskan nilai utama layanan ini untuk calon klien." />
                        <InputError :message="form.errors.description" />
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
                        <Label for="icon_key">Ikon</Label>
                        <select id="icon_key" v-model="form.icon_key" class="border-input focus-visible:border-ring focus-visible:ring-ring/50 h-10 rounded-md border bg-transparent px-3 text-sm outline-none focus-visible:ring-[3px]">
                            <option v-for="option in serviceIconOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </option>
                        </select>
                        <InputError :message="form.errors.icon_key" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="sort_order">Urutan</Label>
                        <Input id="sort_order" v-model="form.sort_order" type="number" min="1" />
                        <InputError :message="form.errors.sort_order" />
                    </div>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_featured" type="checkbox" />
                        Tampilkan sebagai layanan unggulan
                    </label>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_active" type="checkbox" />
                        Aktif di halaman publik
                    </label>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan layanan' : 'Update layanan' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading title="Catatan" description="Gunakan judul layanan yang jelas dan dekat dengan istilah pencarian calon klien, misalnya website company profile atau aplikasi web bisnis." />
        </div>
    </div>
</template>
