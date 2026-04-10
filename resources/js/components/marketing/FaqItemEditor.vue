<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import FaqItemController from '@/actions/App/Http/Controllers/Cms/FaqItemController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { CmsFaqItem } from '@/types';

const props = defineProps<{
    mode: 'create' | 'edit';
    faqItem: CmsFaqItem;
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    question: props.faqItem.question,
    answer: props.faqItem.answer,
    sort_order: props.faqItem.sortOrder,
    is_published: props.faqItem.isPublished,
});

const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

function submit(): void {
    const action =
        props.mode === 'create'
            ? FaqItemController.store()
            : FaqItemController.update(props.faqItem.id ?? 0);

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
                    <CardTitle>Detail FAQ</CardTitle>
                </CardHeader>
                <CardContent class="space-y-6 p-6">
                    <div class="grid gap-2">
                        <Label for="question">Pertanyaan</Label>
                        <Input id="question" v-model="form.question" />
                        <InputError :message="form.errors.question" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="answer">Jawaban</Label>
                        <textarea id="answer" v-model="form.answer" :class="textareaClass" rows="8" />
                        <InputError :message="form.errors.answer" />
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
                    {{ mode === 'create' ? 'Simpan FAQ' : 'Update FAQ' }}
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke daftar</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Pertanyaan yang jelas akan membantu pengunjung dan juga memperkuat schema FAQ di halaman utama."
                variant="small"
            />
        </div>
    </div>
</template>
