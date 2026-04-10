<script setup lang="ts">
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { LoaderCircle, MessageCircle, Send } from 'lucide-vue-next';
import { computed } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useSiteSettings } from '@/composables/useSiteSettings';
import { capture } from '@/routes/leads';

const props = withDefaults(
    defineProps<{
        title?: string;
        description?: string;
        buttonLabel?: string;
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        title: 'Siap Membuat Website Profesional Untuk Bisnismu?',
        buttonLabel: 'Konsultasi Gratis Sekarang',
        theme: 'blue',
    },
);

const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');
const { site } = useSiteSettings();
const page = usePage();

const form = useForm({
    name: '',
    business_name: '',
    phone_number: '',
    email: '',
    service_interest: 'Jasa Pembuatan Aplikasi Web',
    message: '',
});

const resolvedDescription = computed(
    () =>
        props.description ||
        `Tim ${site.value.siteName} siap membantu dari tahap awal hingga website siap digunakan untuk mendukung pertumbuhan bisnismu.`,
);

const textareaClass =
    'min-h-28 rounded-xl border border-white/40 bg-white/90 px-4 py-3 text-sm text-[#2f334e] outline-none transition focus:border-[#2177b8]';

function submit(): void {
    form.post(capture(), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
}
</script>

<template>
    <section
        id="contact"
        :class="[
            'relative overflow-hidden',
            isBrandTheme
                ? 'bg-[linear-gradient(180deg,#eef7fd_0%,#fff6e4_100%)]'
                : isRedTheme
                  ? 'bg-[#fff0f0]'
                  : 'bg-[#dbeaf7]',
        ]"
    >
        <div
            aria-hidden="true"
            :class="[
                'pointer-events-none absolute bottom-0 left-0 h-[170px] w-[170px]',
                isBrandTheme
                    ? 'bg-[linear-gradient(90deg,rgba(33,119,184,0.24)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%),linear-gradient(rgba(33,119,184,0.24)_0_33.33%,transparent_33.33%_66.66%,rgba(246,170,26,0.18)_66.66%_100%)]'
                    : isRedTheme
                      ? 'bg-[linear-gradient(90deg,rgba(228,171,171,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(228,171,171,0.2)_66.66%_100%),linear-gradient(rgba(228,171,171,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(228,171,171,0.2)_66.66%_100%)]'
                      : 'bg-[linear-gradient(90deg,rgba(173,198,221,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(173,198,221,0.2)_66.66%_100%),linear-gradient(rgba(173,198,221,0.4)_0_33.33%,transparent_33.33%_66.66%,rgba(173,198,221,0.2)_66.66%_100%)]',
            ]"
        />

        <div
            class="mx-auto grid w-[min(1280px,calc(100%-1.5rem))] items-start gap-8 py-8 md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[minmax(0,1fr)_minmax(0,520px)] lg:py-12"
        >
            <div class="relative z-10 max-w-[560px]">
                <h2
                    class="text-[18px] leading-[1.35] font-bold tracking-[-0.02em] text-[#272b45] md:text-[30px]"
                >
                    {{ props.title }}
                </h2>
                <p
                    class="mt-5 max-w-[500px] text-[15px] leading-[1.7] text-[#6b7088] md:text-[16px]"
                >
                    {{ resolvedDescription }}
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a
                        :href="site.whatsappUrl"
                        :class="[
                            'inline-flex w-full items-center justify-center gap-3 rounded-[14px] border-2 px-6 py-3.5 text-[15px] leading-none font-semibold text-white transition-transform hover:-translate-y-px sm:w-auto sm:min-w-[250px] sm:text-[16px]',
                            isBrandTheme
                                ? 'border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(214,136,0,0.28)]'
                                : isRedTheme
                                  ? 'border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(185,67,67,0.28)]'
                                  : 'border-[#1d88d3] bg-gradient-to-b from-[#1cb0fb] to-[#108fdd] shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(28,128,196,0.28)]',
                        ]"
                    >
                        <MessageCircle :size="22" :stroke-width="2.2" />
                        <span>{{ props.buttonLabel }}</span>
                    </a>
                    <Button
                        variant="outline"
                        class="h-auto rounded-[14px] border-[#dce8f4] bg-white/80 px-6 py-3.5 text-[#2f334e]"
                        as-child
                    >
                        <Link href="#lead-form">Kirim Brief</Link>
                    </Button>
                </div>
            </div>

            <div
                id="lead-form"
                class="rounded-[28px] border border-[#dce8f4] bg-white/86 p-6 shadow-[0_16px_30px_rgba(31,91,143,0.10)] backdrop-blur"
            >
                <p
                    class="text-[12px] font-semibold tracking-[0.18em] text-[#8f98af] uppercase"
                >
                    Contact Inbox
                </p>
                <h3
                    class="mt-3 text-[24px] font-semibold tracking-[-0.02em] text-[#2f334e]"
                >
                    Kirim brief singkat
                </h3>
                <p class="mt-2 text-[14px] leading-7 text-[#6b7088]">
                    Isi kebutuhan utama Anda. Data ini akan masuk ke CMS agar tim
                    bisa follow up lebih rapi.
                </p>

                <p
                    v-if="page.props.flash?.success"
                    class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                >
                    {{ page.props.flash.success }}
                </p>

                <form class="mt-6 grid gap-4" @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="lead_name">Nama</Label>
                        <Input id="lead_name" v-model="form.name" placeholder="Nama Anda" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="lead_business_name">Nama bisnis</Label>
                            <Input
                                id="lead_business_name"
                                v-model="form.business_name"
                                placeholder="Opsional"
                            />
                            <InputError :message="form.errors.business_name" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="lead_phone_number">WhatsApp / telepon</Label>
                            <Input
                                id="lead_phone_number"
                                v-model="form.phone_number"
                                placeholder="08xxxxxxxxxx"
                            />
                            <InputError :message="form.errors.phone_number" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="grid gap-2">
                            <Label for="lead_email">Email</Label>
                            <Input
                                id="lead_email"
                                v-model="form.email"
                                type="email"
                                placeholder="Opsional"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="lead_service_interest">Kebutuhan utama</Label>
                            <select
                                id="lead_service_interest"
                                v-model="form.service_interest"
                                class="h-10 rounded-xl border border-white/40 bg-white/90 px-4 text-sm text-[#2f334e] outline-none transition focus:border-[#2177b8]"
                            >
                                <option value="Jasa Pembuatan Aplikasi Web">
                                    Jasa Pembuatan Aplikasi Web
                                </option>
                                <option value="Website Company Profile">
                                    Website Company Profile
                                </option>
                                <option value="Landing Page Promosi">
                                    Landing Page Promosi
                                </option>
                                <option value="SEO Lokal Makassar">
                                    SEO Lokal Makassar
                                </option>
                            </select>
                            <InputError :message="form.errors.service_interest" />
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <Label for="lead_message">Brief proyek</Label>
                        <textarea
                            id="lead_message"
                            v-model="form.message"
                            :class="textareaClass"
                            placeholder="Ceritakan bisnis Anda, fitur yang dibutuhkan, dan target wilayah seperti Makassar."
                        />
                        <InputError :message="form.errors.message" />
                    </div>

                    <Button
                        :disabled="form.processing"
                        class="mt-2 h-auto justify-center rounded-[14px] border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-6 py-3.5 text-[15px] font-semibold text-white shadow-[inset_0_2px_0_rgba(255,255,255,0.34),0_14px_28px_rgba(214,136,0,0.28)]"
                        type="submit"
                    >
                        <LoaderCircle v-if="form.processing" class="size-4 animate-spin" />
                        <Send v-else class="size-4" />
                        Kirim ke CMS
                    </Button>
                </form>
            </div>

            <div
                aria-hidden="true"
                class="relative hidden min-h-[520px] lg:flex lg:items-center lg:justify-end"
            >
                <div class="relative h-[520px] w-full origin-top-right translate-y-8 scale-[0.86]">
                    <img
                        src="/images/landing/cta.png"
                        alt="Ilustrasi layanan website Frametech"
                        class="pointer-events-none absolute bottom-[-44px] left-[53%] z-20 w-[460px] -translate-x-1/2 object-contain [-webkit-mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)] [mask-image:linear-gradient(to_bottom,black_0%,black_78%,transparent_100%)]"
                    />
                    <div
                        class="absolute top-8 left-[-36px] z-10 inline-flex min-w-[380px] items-center gap-4 rounded-[30px] border border-[#dce5ef] bg-[#fcfdff] px-6 py-5 shadow-[0_12px_26px_rgba(38,73,106,0.13)]"
                    >
                        <span
                            :class="[
                                'grid h-[78px] w-[78px] shrink-0 place-items-center rounded-full',
                                isBrandTheme
                                    ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af]'
                                    : isRedTheme
                                      ? 'bg-gradient-to-b from-[#f06f6f] to-[#d44242]'
                                      : 'bg-gradient-to-b from-[#1cb1fb] to-[#0f8edf]',
                            ]"
                        >
                            <span class="h-6 w-8 rounded-lg border-2 border-white" />
                        </span>
                        <div>
                            <p
                                :class="[
                                    'inline-flex items-center gap-2 text-[22px] leading-none font-semibold',
                                    isBrandTheme
                                        ? 'text-[#1f79bc]'
                                        : isRedTheme
                                          ? 'text-[#d45b5b]'
                                          : 'text-[#4b92d4]',
                                ]"
                            >
                                12
                                <span
                                    class="inline-flex items-center rounded-full bg-[#27ba5d] px-3 py-1 text-[13px] leading-none font-bold text-white"
                                >
                                    ▲ 22%
                                </span>
                            </p>
                            <p class="mt-2 text-[16px] leading-tight font-semibold text-[#2b2f45]">
                                Formulir Kontak Masuk
                            </p>
                        </div>
                    </div>
                    <div
                        class="absolute right-2 bottom-[-10px] z-30 inline-flex min-w-[320px] items-center gap-4 rounded-[30px] border border-[#dce5ef] bg-[#fcfdff] px-6 py-5 shadow-[0_12px_26px_rgba(38,73,106,0.13)]"
                    >
                        <span
                            :class="[
                                'grid h-[78px] w-[78px] shrink-0 place-items-center rounded-full text-[36px] text-white',
                                isBrandTheme
                                    ? 'bg-gradient-to-b from-[#2a86c9] to-[#1769af]'
                                    : isRedTheme
                                      ? 'bg-gradient-to-b from-[#f06f6f] to-[#d44242]'
                                      : 'bg-gradient-to-b from-[#1cb1fb] to-[#0f8edf]',
                            ]"
                        >
                            ★
                        </span>
                        <div>
                            <p
                                :class="[
                                    'text-[22px] leading-none font-semibold',
                                    isBrandTheme
                                        ? 'text-[#1f79bc]'
                                        : isRedTheme
                                          ? 'text-[#d45b5b]'
                                          : 'text-[#4b92d4]',
                                ]"
                            >
                                4.8/5
                            </p>
                            <p class="mt-2 text-[16px] leading-tight font-semibold text-[#2b2f45]">
                                Rating Bisnismu
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
