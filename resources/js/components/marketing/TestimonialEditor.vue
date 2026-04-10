<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import TestimonialController from '@/actions/App/Http/Controllers/Cms/TestimonialController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsTestimonial } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    testimonial: CmsTestimonial;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    name: props.testimonial.name,
    role: props.testimonial.role,
    quote: props.testimonial.quote,
    avatar_url: props.testimonial.avatarUrl,
    rating: props.testimonial.rating,
    sort_order: props.testimonial.sortOrder,
    is_published: props.testimonial.isPublished,
});

const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

function submit(): void {
    const action =
        props.mode === 'create'
            ? TestimonialController.store()
            : TestimonialController.update(props.testimonial.id ?? 0);

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
                    <CardTitle>Detail testimoni</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="name">Nama klien</Label>
                        <Input id="name" v-model="form.name" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="role">Peran / bisnis</Label>
                        <Input id="role" v-model="form.role" />
                        <InputError :message="form.errors.role" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="quote">Isi testimoni</Label>
                        <textarea id="quote" v-model="form.quote" :class="textareaClass" rows="6" />
                        <InputError :message="form.errors.quote" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="avatar_url">URL foto</Label>
                        <Input id="avatar_url" v-model="form.avatar_url" placeholder="https://..." />
                        <InputError :message="form.errors.avatar_url" />
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Pengaturan</CardTitle>
                </CardHeader>
                <CardContent class="space-y-5 p-6">
                    <div class="grid gap-2">
                        <Label for="rating">Rating</Label>
                        <Input id="rating" v-model="form.rating" type="number" min="1" max="5" />
                        <InputError :message="form.errors.rating" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="sort_order">Urutan</Label>
                        <Input id="sort_order" v-model="form.sort_order" type="number" min="1" />
                        <InputError :message="form.errors.sort_order" />
                    </div>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_published" type="checkbox" />
                        Tampilkan di halaman publik
                    </label>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan testimoni' : 'Update testimoni' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Gunakan testimoni yang spesifik pada hasil bisnis atau pengalaman kerja sama agar lebih meyakinkan."
                variant="small"
            />
        </div>
    </div>
</template>
