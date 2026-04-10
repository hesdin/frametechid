<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import MediaAssetController from '@/actions/App/Http/Controllers/Cms/MediaAssetController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsMediaAsset } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    mediaAsset: CmsMediaAsset;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    title: props.mediaAsset.title,
    alt_text: props.mediaAsset.altText,
    file: null as File | null,
});

function assignFile(event: Event): void {
    const target = event.target as HTMLInputElement;
    form.file = target.files?.[0] ?? null;
}

function submit(): void {
    const action =
        props.mode === 'create'
            ? MediaAssetController.store()
            : MediaAssetController.update(props.mediaAsset.id ?? 0);

    form.submit(action, {
        forceFormData: true,
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
                    <CardTitle>Detail media</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="title">Judul asset</Label>
                        <Input id="title" v-model="form.title" placeholder="Banner layanan" />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="alt_text">Alt text</Label>
                        <Input id="alt_text" v-model="form.alt_text" placeholder="Deskripsi singkat gambar" />
                        <InputError :message="form.errors.alt_text" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="file">File</Label>
                        <input id="file" type="file" accept=".jpg,.jpeg,.png,.webp,.svg" @change="assignFile" />
                        <InputError :message="form.errors.file" />
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card v-if="mediaAsset.url" class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Preview</CardTitle>
                </CardHeader>
                <CardContent class="space-y-4 p-6">
                    <img :src="mediaAsset.url" :alt="mediaAsset.altText || mediaAsset.title || 'Media asset'" class="max-h-56 w-full rounded-xl border object-contain p-2" />
                    <div class="space-y-1 text-sm text-muted-foreground">
                        <p v-if="mediaAsset.mimeType">Tipe: {{ mediaAsset.mimeType }}</p>
                        <p v-if="mediaAsset.fileSize">Ukuran: {{ mediaAsset.fileSize }} byte</p>
                    </div>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Upload media' : 'Update media' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Media Library memudahkan reuse asset untuk blog, layanan, dan setting situs tanpa mengulang upload."
                variant="small"
            />
        </div>
    </div>
</template>
