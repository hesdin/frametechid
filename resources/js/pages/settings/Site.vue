<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import SiteSettingController from '@/actions/App/Http/Controllers/Settings/SiteSettingController';
import FlashMessage from '@/components/FlashMessage.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { edit } from '@/routes/site-settings';
import type { BreadcrumbItem } from '@/types';
import type { EditableSiteSettings } from '@/types/site';

const props = defineProps<{
    settings: EditableSiteSettings;
}>();

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Site settings',
        href: edit(),
    },
];

const form = useForm({
    siteName: props.settings.siteName,
    companyDescription: props.settings.companyDescription,
    phoneNumber: props.settings.phoneNumber,
    whatsappNumber: props.settings.whatsappNumber,
    email: props.settings.email ?? '',
    address: props.settings.address ?? '',
    businessHours: props.settings.businessHours ?? '',
    instagramUrl: props.settings.instagramUrl ?? '',
    facebookUrl: props.settings.facebookUrl ?? '',
    linkedinUrl: props.settings.linkedinUrl ?? '',
    tiktokUrl: props.settings.tiktokUrl ?? '',
    youtubeUrl: props.settings.youtubeUrl ?? '',
    copyrightName: props.settings.copyrightName ?? '',
    seoTitle: props.settings.seoTitle ?? '',
    seoDescription: props.settings.seoDescription ?? '',
    seoKeywords: props.settings.seoKeywords ?? '',
    seoLocality: props.settings.seoLocality ?? '',
    seoRegion: props.settings.seoRegion ?? '',
    seoFocusKeyword: props.settings.seoFocusKeyword ?? '',
    logo: null as File | null,
    favicon: null as File | null,
    remove_logo: false,
    remove_favicon: false,
});

const currentLogoUrl = computed(() =>
    form.remove_logo ? null : (props.settings.logoUrl ?? null),
);
const currentFaviconUrl = computed(() =>
    form.remove_favicon ? null : (props.settings.faviconUrl ?? null),
);

function assignFile(
    event: Event,
    field: 'logo' | 'favicon',
    resetField: 'remove_logo' | 'remove_favicon',
): void {
    const target = event.target as HTMLInputElement;
    form[field] = target.files?.[0] ?? null;
    form[resetField] = false;
}

function submit(): void {
    form.submit(SiteSettingController.update(), {
        forceFormData: true,
        preserveScroll: true,
    });
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Site settings" />

        <SettingsLayout>
            <div class="space-y-6">
                <FlashMessage :message="page.props.flash?.success" />

                <Heading
                    variant="small"
                    title="Brand & Kontak"
                    description="Kelola logo, favicon, nomor telepon, sosial media, dan informasi penting lain yang tampil di website."
                />

                <form class="space-y-8" @submit.prevent="submit">
                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="grid gap-2">
                            <Label for="siteName">Nama situs</Label>
                            <Input id="siteName" v-model="form.siteName" />
                            <InputError :message="form.errors.siteName" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="companyDescription">Deskripsi singkat</Label>
                            <textarea
                                id="companyDescription"
                                v-model="form.companyDescription"
                                class="border-input focus-visible:border-ring focus-visible:ring-ring/50 min-h-32 rounded-md border bg-transparent px-3 py-2 text-sm outline-none focus-visible:ring-[3px]"
                            />
                            <InputError :message="form.errors.companyDescription" />
                        </div>
                    </div>

                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="grid gap-2">
                            <Label for="logo">Logo</Label>
                            <input
                                id="logo"
                                type="file"
                                accept=".jpg,.jpeg,.png,.webp,.svg"
                                @change="assignFile($event, 'logo', 'remove_logo')"
                            />
                            <label class="inline-flex items-center gap-2 text-sm text-muted-foreground">
                                <input v-model="form.remove_logo" type="checkbox" />
                                Hapus logo custom
                            </label>
                            <img
                                v-if="currentLogoUrl"
                                :src="currentLogoUrl"
                                alt="Current logo"
                                class="h-16 w-16 rounded-xl border object-contain p-2"
                            />
                            <InputError :message="form.errors.logo" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="favicon">Favicon</Label>
                            <input
                                id="favicon"
                                type="file"
                                accept=".ico,.png,.svg,.webp"
                                @change="assignFile($event, 'favicon', 'remove_favicon')"
                            />
                            <label class="inline-flex items-center gap-2 text-sm text-muted-foreground">
                                <input v-model="form.remove_favicon" type="checkbox" />
                                Hapus favicon custom
                            </label>
                            <img
                                v-if="currentFaviconUrl"
                                :src="currentFaviconUrl"
                                alt="Current favicon"
                                class="h-12 w-12 rounded-lg border object-contain p-1"
                            />
                            <InputError :message="form.errors.favicon" />
                        </div>
                    </div>

                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="grid gap-2">
                            <Label for="phoneNumber">Nomor telepon</Label>
                            <Input id="phoneNumber" v-model="form.phoneNumber" />
                            <InputError :message="form.errors.phoneNumber" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="whatsappNumber">Nomor WhatsApp</Label>
                            <Input id="whatsappNumber" v-model="form.whatsappNumber" />
                            <p class="text-sm text-muted-foreground">
                                Gunakan format internasional, misalnya `628123456789`.
                            </p>
                            <InputError :message="form.errors.whatsappNumber" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" v-model="form.email" type="email" />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="address">Alamat</Label>
                            <Input id="address" v-model="form.address" />
                            <InputError :message="form.errors.address" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="businessHours">Jam operasional</Label>
                            <Input id="businessHours" v-model="form.businessHours" />
                            <InputError :message="form.errors.businessHours" />
                        </div>
                    </div>

                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="grid gap-2">
                            <Label for="instagramUrl">Instagram</Label>
                            <Input id="instagramUrl" v-model="form.instagramUrl" />
                            <InputError :message="form.errors.instagramUrl" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="facebookUrl">Facebook</Label>
                            <Input id="facebookUrl" v-model="form.facebookUrl" />
                            <InputError :message="form.errors.facebookUrl" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="linkedinUrl">LinkedIn</Label>
                            <Input id="linkedinUrl" v-model="form.linkedinUrl" />
                            <InputError :message="form.errors.linkedinUrl" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="tiktokUrl">TikTok</Label>
                            <Input id="tiktokUrl" v-model="form.tiktokUrl" />
                            <InputError :message="form.errors.tiktokUrl" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="youtubeUrl">YouTube</Label>
                            <Input id="youtubeUrl" v-model="form.youtubeUrl" />
                            <InputError :message="form.errors.youtubeUrl" />
                        </div>
                    </div>

                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="grid gap-2">
                            <Label for="copyrightName">Nama copyright</Label>
                            <Input id="copyrightName" v-model="form.copyrightName" />
                            <InputError :message="form.errors.copyrightName" />
                        </div>
                    </div>

                    <div class="grid gap-6 rounded-2xl border p-6">
                        <div class="space-y-1">
                            <h3 class="text-base font-semibold">SEO & Pencarian Lokal</h3>
                            <p class="text-sm text-muted-foreground">
                                Gunakan keyword yang memang ingin ditarget, misalnya
                                `jasa pembuatan aplikasi makassar`.
                            </p>
                        </div>

                        <div class="grid gap-2">
                            <Label for="seoTitle">SEO title default</Label>
                            <Input id="seoTitle" v-model="form.seoTitle" />
                            <InputError :message="form.errors.seoTitle" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="seoDescription">Meta description</Label>
                            <textarea
                                id="seoDescription"
                                v-model="form.seoDescription"
                                class="border-input focus-visible:border-ring focus-visible:ring-ring/50 min-h-28 rounded-md border bg-transparent px-3 py-2 text-sm outline-none focus-visible:ring-[3px]"
                            />
                            <div class="flex items-center justify-between text-xs text-muted-foreground">
                                <span>Maksimal 320 karakter.</span>
                                <span>{{ form.seoDescription.length }}/320</span>
                            </div>
                            <InputError :message="form.errors.seoDescription" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="seoKeywords">Keyword SEO</Label>
                            <textarea
                                id="seoKeywords"
                                v-model="form.seoKeywords"
                                class="border-input focus-visible:border-ring focus-visible:ring-ring/50 min-h-24 rounded-md border bg-transparent px-3 py-2 text-sm outline-none focus-visible:ring-[3px]"
                                placeholder="jasa pembuatan aplikasi makassar, jasa pembuatan website makassar"
                            />
                            <p class="text-xs text-muted-foreground">
                                Pisahkan antar keyword dengan koma.
                            </p>
                            <InputError :message="form.errors.seoKeywords" />
                        </div>

                        <div class="grid gap-4 md:grid-cols-3">
                            <div class="grid gap-2">
                                <Label for="seoLocality">Kota target</Label>
                                <Input id="seoLocality" v-model="form.seoLocality" placeholder="Makassar" />
                                <InputError :message="form.errors.seoLocality" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="seoRegion">Provinsi / region</Label>
                                <Input id="seoRegion" v-model="form.seoRegion" placeholder="Sulawesi Selatan" />
                                <InputError :message="form.errors.seoRegion" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="seoFocusKeyword">Focus keyword</Label>
                                <Input id="seoFocusKeyword" v-model="form.seoFocusKeyword" placeholder="Jasa Pembuatan Aplikasi Makassar" />
                                <InputError :message="form.errors.seoFocusKeyword" />
                            </div>
                        </div>
                    </div>

                    <Button :disabled="form.processing" type="submit">
                        Simpan pengaturan situs
                    </Button>
                </form>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
