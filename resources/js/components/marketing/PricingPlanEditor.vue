<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import PricingPlanController from '@/actions/App/Http/Controllers/Cms/PricingPlanController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { pricingAccentOptions } from '@/lib/marketing';
import type { CmsPricingPlan } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    plan: CmsPricingPlan;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    name: props.plan.name,
    slug: props.plan.slug,
    summary: props.plan.summary,
    previous_price: props.plan.previousPrice,
    price: props.plan.price,
    discount_label: props.plan.discountLabel,
    note: props.plan.note,
    cta_label: props.plan.ctaLabel,
    featuresText: props.plan.featuresText,
    icon_letter: props.plan.iconLetter,
    accent_tone: props.plan.accentTone,
    sort_order: props.plan.sortOrder,
    is_featured: props.plan.isFeatured,
    is_active: props.plan.isActive,
});

const syncSlugWithTitle = ref(props.mode === 'create' && props.plan.slug.length === 0);
const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

watch(
    () => form.name,
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
    form.slug = slugify(form.name);
}

function handleSlugInput(value: string | number): void {
    syncSlugWithTitle.value = false;
    form.slug = slugify(String(value));
}

function submit(): void {
    const action =
        props.mode === 'create'
            ? PricingPlanController.store()
            : PricingPlanController.update(props.plan.id ?? 0);

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
                    <CardTitle>Detail paket</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="name">Nama paket</Label>
                        <Input id="name" v-model="form.name" placeholder="Paket Growth" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <div class="flex items-center justify-between gap-3">
                            <Label for="slug">Slug</Label>
                            <button type="button" class="text-xs font-medium text-primary transition hover:opacity-80" @click="regenerateSlug">
                                Generate dari judul
                            </button>
                        </div>
                        <Input id="slug" :model-value="form.slug" placeholder="paket-growth" @update:model-value="handleSlugInput" />
                        <InputError :message="form.errors.slug" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="summary">Ringkasan</Label>
                        <textarea id="summary" v-model="form.summary" :class="textareaClass" rows="4" />
                        <InputError :message="form.errors.summary" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="previous_price">Harga coret</Label>
                            <Input id="previous_price" v-model="form.previous_price" placeholder="Rp6.500.000" />
                            <InputError :message="form.errors.previous_price" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="price">Harga utama</Label>
                            <Input id="price" v-model="form.price" placeholder="Rp4.500.000" />
                            <InputError :message="form.errors.price" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="discount_label">Badge diskon</Label>
                            <Input id="discount_label" v-model="form.discount_label" placeholder="Diskon 31%" />
                            <InputError :message="form.errors.discount_label" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="cta_label">Label tombol</Label>
                            <Input id="cta_label" v-model="form.cta_label" placeholder="Pilih Paket Ini" />
                            <InputError :message="form.errors.cta_label" />
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="note">Catatan</Label>
                        <Input id="note" v-model="form.note" placeholder="Paket paling seimbang untuk brand yang sedang aktif promosi." />
                        <InputError :message="form.errors.note" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="featuresText">Fitur paket</Label>
                        <textarea id="featuresText" v-model="form.featuresText" :class="textareaClass" rows="8" placeholder="Satu fitur per baris" />
                        <p class="text-xs text-muted-foreground">Isi satu fitur per baris.</p>
                        <InputError :message="form.errors.featuresText ?? form.errors.features" />
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
                        <Label for="icon_letter">Huruf ikon</Label>
                        <Input id="icon_letter" v-model="form.icon_letter" maxlength="2" />
                        <InputError :message="form.errors.icon_letter" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="accent_tone">Aksen warna</Label>
                        <select id="accent_tone" v-model="form.accent_tone" class="border-input focus-visible:border-ring focus-visible:ring-ring/50 h-10 rounded-md border bg-transparent px-3 text-sm outline-none focus-visible:ring-[3px]">
                            <option v-for="option in pricingAccentOptions" :key="option.value" :value="option.value">
                                {{ option.label }}
                            </option>
                        </select>
                        <InputError :message="form.errors.accent_tone" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="sort_order">Urutan</Label>
                        <Input id="sort_order" v-model="form.sort_order" type="number" min="1" />
                        <InputError :message="form.errors.sort_order" />
                    </div>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_featured" type="checkbox" />
                        Tandai sebagai paket unggulan
                    </label>

                    <label class="flex items-center gap-3 text-sm">
                        <input v-model="form.is_active" type="checkbox" />
                        Aktif di halaman publik
                    </label>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    {{ mode === 'create' ? 'Simpan paket' : 'Update paket' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading title="Catatan" description="Paket harga yang jelas membantu conversion rate dan memperkuat keyword seperti harga jasa pembuatan website atau aplikasi di Makassar." />
        </div>
    </div>
</template>
