<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import PostController from '@/actions/App/Http/Controllers/Cms/PostController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsEditablePost } from '@/types/blog';

const props = defineProps<{
    mode: 'create' | 'edit';
    post: CmsEditablePost;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    title: props.post.title,
    slug: props.post.slug,
    excerpt: props.post.excerpt,
    content: props.post.content,
    cover_image: props.post.coverImage,
    status: props.post.status,
});

const syncSlugWithTitle = ref(
    props.mode === 'create' && props.post.slug.length === 0,
);

const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

const statusLabel = computed(() =>
    form.status === 'published'
        ? 'Siap tampil di halaman blog publik.'
        : 'Masih tersimpan sebagai draft di CMS.',
);

const editablePostId = computed(() => props.post.id ?? null);

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
    if (props.mode === 'edit' && editablePostId.value === null) {
        return;
    }

    const action =
        props.mode === 'create'
            ? PostController.store()
            : PostController.update(editablePostId.value);

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
                    <CardTitle>Detail artikel</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="title">Judul</Label>
                        <Input
                            id="title"
                            v-model="form.title"
                            placeholder="Contoh: Cara Bangun Website Bisnis yang Lebih Meyakinkan"
                        />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between gap-3">
                            <Label for="slug">Slug</Label>
                            <button
                                type="button"
                                class="text-xs font-medium text-primary transition hover:opacity-80"
                                @click="regenerateSlug"
                            >
                                Generate dari judul
                            </button>
                        </div>
                        <Input
                            id="slug"
                            :model-value="form.slug"
                            placeholder="cara-bangun-website-bisnis"
                            @update:model-value="handleSlugInput"
                        />
                        <InputError :message="form.errors.slug" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="excerpt">Ringkasan</Label>
                        <textarea
                            id="excerpt"
                            v-model="form.excerpt"
                            :class="textareaClass"
                            rows="4"
                            placeholder="Ringkasan singkat untuk card blog dan preview mesin pencari."
                        />
                        <div
                            class="flex items-center justify-between text-xs text-muted-foreground"
                        >
                            <span>Maksimal 320 karakter.</span>
                            <span>{{ form.excerpt.length }}/320</span>
                        </div>
                        <InputError :message="form.errors.excerpt" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="content">Isi artikel</Label>
                        <textarea
                            id="content"
                            v-model="form.content"
                            :class="textareaClass"
                            rows="16"
                            placeholder="Tulis artikel lengkap. Pisahkan paragraf dengan baris kosong."
                        />
                        <InputError :message="form.errors.content" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="cover_image">Cover image URL</Label>
                        <Input
                            id="cover_image"
                            v-model="form.cover_image"
                            placeholder="https://images.unsplash.com/..."
                        />
                        <InputError :message="form.errors.cover_image" />
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Publish settings</CardTitle>
                </CardHeader>
                <CardContent class="space-y-5 p-6">
                    <div class="grid gap-2">
                        <Label for="status">Status</Label>
                        <select
                            id="status"
                            v-model="form.status"
                            class="border-input focus-visible:border-ring focus-visible:ring-ring/50 h-10 rounded-md border bg-transparent px-3 text-sm outline-none focus-visible:ring-[3px]"
                        >
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                        <p class="text-sm text-muted-foreground">
                            {{ statusLabel }}
                        </p>
                        <InputError :message="form.errors.status" />
                    </div>

                    <div class="space-y-3 rounded-xl border bg-muted/20 p-4">
                        <p class="text-sm font-medium">Preview metadata</p>
                        <div class="space-y-1 text-sm text-muted-foreground">
                            <p>Judul: {{ form.title || 'Belum diisi' }}</p>
                            <p>Slug: /blog/{{ form.slug || 'slug-artikel' }}</p>
                            <p>
                                Cover:
                                {{
                                    form.cover_image
                                        ? 'Tersedia'
                                        : 'Belum ada URL cover'
                                }}
                            </p>
                        </div>
                    </div>

                    <div
                        v-if="post.publishedAt || post.updatedAt"
                        class="space-y-1 text-sm text-muted-foreground"
                    >
                        <p v-if="post.publishedAt">
                            Published: {{ post.publishedAt }}
                        </p>
                        <p v-if="post.updatedAt">
                            Update terakhir: {{ post.updatedAt }}
                        </p>
                    </div>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button
                    :disabled="form.processing"
                    class="w-full justify-center"
                    @click="submit"
                >
                    {{ mode === 'create' ? 'Simpan artikel' : 'Update artikel' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Slug akan dipakai sebagai URL publik. Ubah hanya jika memang perlu."
                variant="small"
            />
        </div>
    </div>
</template>
