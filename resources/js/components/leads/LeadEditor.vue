<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import LeadController from '@/actions/App/Http/Controllers/Cms/LeadController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import type { CmsLead, LeadStatus } from '@/types';

const props = defineProps<{
    lead: CmsLead;
    statusOptions: LeadStatus[];
    flashMessage?: string | null;
    cancelHref: string;
}>();

const form = useForm({
    status: props.lead.status,
    notes: props.lead.notes ?? '',
});

const textareaClass =
    'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 w-full rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]';

function submit(): void {
    form.submit(LeadController.update(props.lead.id), {
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
                    <CardTitle>Detail lead</CardTitle>
                </CardHeader>
                <CardContent class="grid gap-4 p-6 text-sm">
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Nama</span>
                        <p class="font-medium">{{ lead.name }}</p>
                    </div>
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Bisnis</span>
                        <p class="font-medium">{{ lead.businessName || '-' }}</p>
                    </div>
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Telepon</span>
                        <p class="font-medium">{{ lead.phoneNumber }}</p>
                    </div>
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Email</span>
                        <p class="font-medium">{{ lead.email || '-' }}</p>
                    </div>
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Kebutuhan</span>
                        <p class="font-medium">{{ lead.serviceInterest || '-' }}</p>
                    </div>
                    <div class="grid gap-1">
                        <span class="text-muted-foreground">Pesan</span>
                        <p class="leading-7 text-foreground">{{ lead.message }}</p>
                    </div>
                </CardContent>
            </Card>
        </div>

        <div class="space-y-6">
            <Card class="gap-0 overflow-hidden py-0">
                <CardHeader class="border-b bg-muted/30">
                    <CardTitle>Tindak lanjut</CardTitle>
                </CardHeader>
                <CardContent class="space-y-5 p-6">
                    <div class="grid gap-2">
                        <Label for="status">Status</Label>
                        <select
                            id="status"
                            v-model="form.status"
                            class="border-input focus-visible:border-ring focus-visible:ring-ring/50 h-10 rounded-md border bg-transparent px-3 text-sm outline-none focus-visible:ring-[3px]"
                        >
                            <option v-for="status in statusOptions" :key="status" :value="status">
                                {{ status }}
                            </option>
                        </select>
                        <InputError :message="form.errors.status" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="notes">Catatan internal</Label>
                        <textarea id="notes" v-model="form.notes" :class="textareaClass" rows="6" />
                        <InputError :message="form.errors.notes" />
                    </div>

                    <div class="space-y-1 text-sm text-muted-foreground">
                        <p>Sumber: {{ lead.source }}</p>
                        <p v-if="lead.contactedAt">Dihubungi: {{ lead.contactedAt }}</p>
                    </div>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row xl:flex-col">
                <Button :disabled="form.processing" class="w-full justify-center" @click="submit">
                    Update lead
                </Button>
                <Button variant="outline" class="w-full justify-center" as-child>
                    <Link :href="cancelHref">Kembali ke inbox</Link>
                </Button>
            </div>

            <Heading
                title="Catatan"
                description="Status dan catatan lead akan membantu tim menandai mana kontak yang sudah dihubungi dan mana yang paling potensial."
                variant="small"
            />
        </div>
    </div>
</template>
