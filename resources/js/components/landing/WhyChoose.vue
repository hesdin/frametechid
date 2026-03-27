<script setup lang="ts">
import { CheckCircle2, CirclePlay, X } from 'lucide-vue-next';
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';

const defaultPoints = [
    'Desain modern dan cepat dimuat',
    'Terhubung langsung ke WhatsApp',
    'Mudah di-update tanpa ribet',
    'Harga transparan tanpa biaya tersembunyi',
    'Pendampingan sampai website siap live',
    'Dukungan teknis setelah website jadi',
];

const props = withDefaults(
    defineProps<{
        sectionId?: string;
        title?: string;
        description?: string;
        points?: string[];
        imageSrc?: string;
        imageAlt?: string;
        profileName?: string;
        profileRole?: string;
        theme?: 'blue' | 'red' | 'brand';
    }>(),
    {
        sectionId: undefined,
        title: 'Kenapa Banyak Bisnis Memilih Frametech',
        description:
            'Kami fokus membuat website yang rapi secara tampilan, jelas secara pesan, dan langsung bisa dipakai untuk mendatangkan calon pelanggan baru.',
        imageSrc: '/images/landing/why-chose-us.png',
        imageAlt: 'Tim Frametech membantu bisnis dengan solusi digital',
        profileName: 'Timotius Muliawan',
        profileRole: 'Founder Frametech',
        theme: 'blue',
    },
);

const points = computed(() => props.points ?? defaultPoints);
const isRedTheme = computed(() => props.theme === 'red');
const isBrandTheme = computed(() => props.theme === 'brand');

const isModalOpen = ref(false);
const videoEmbedUrl = 'https://www.youtube.com/embed/tyYzl0x1DEk';

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const onKeydown = (event: KeyboardEvent) => {
    if (event.key === 'Escape') {
        closeModal();
    }
};

watch(isModalOpen, (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : '';
});

onMounted(() => {
    window.addEventListener('keydown', onKeydown);
});

onBeforeUnmount(() => {
    window.removeEventListener('keydown', onKeydown);
    document.body.style.overflow = '';
});
</script>

<template>
    <section :id="sectionId" class="py-30 md:py-34">
        <div
            class="mx-auto grid w-[min(1280px,calc(100%-1.5rem))] items-center gap-14 md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[1.05fr_1fr]"
        >
            <article
                :class="[
                    'relative overflow-hidden rounded-[28px] p-0',
                    isBrandTheme
                        ? 'border border-[#d8e7f5] bg-[linear-gradient(135deg,#edf7fd_0%,#f8fcff_42%,#fff4dd_100%)]'
                        : isRedTheme
                          ? 'border border-[#f0d0d0] bg-[linear-gradient(135deg,#fff1f1_0%,#fff8f8_42%,#fde5e5_100%)]'
                          : 'border border-[#d7e4ef] bg-[linear-gradient(135deg,#e9f4ff_0%,#f7fbff_42%,#dae7f4_100%)]',
                ]"
            >
                <img
                    :src="imageSrc"
                    :alt="imageAlt"
                    class="mx-auto h-full min-h-[480px] w-[74%] object-contain object-bottom"
                />

                <button
                    type="button"
                    :class="[
                        'absolute top-1/2 left-1/2 grid h-[88px] w-[88px] -translate-x-1/2 -translate-y-1/2 place-items-center rounded-full bg-white shadow-[0_14px_22px_rgba(25,53,85,0.2)] transition-transform hover:scale-105',
                        isBrandTheme ? 'text-[#de8a00]' : 'text-[#aeb7c4]',
                    ]"
                    aria-label="Putar video"
                    @click="openModal"
                >
                    <CirclePlay :size="44" fill="currentColor" />
                </button>

                <span
                    class="absolute top-6 left-6 grid h-[70px] w-[70px] place-items-center rounded-full bg-white/80 text-4xl"
                >
                    🇺🇸
                </span>
                <span
                    class="absolute top-1/2 right-7 grid h-[70px] w-[70px] -translate-y-1/2 place-items-center rounded-full bg-white/80 text-4xl"
                >
                    🇫🇷
                </span>
                <span
                    class="absolute bottom-6 left-6 grid h-[70px] w-[70px] place-items-center rounded-full bg-white/80 text-4xl"
                >
                    🇦🇺
                </span>

                <div
                    class="absolute right-8 bottom-8 rounded-xl border border-white/70 bg-white/85 px-6 py-4 shadow-[0_10px_18px_rgba(31,78,118,0.15)]"
                >
                    <p class="text-[16px] text-[#5c6a84]">{{ profileName }}</p>
                    <p class="mt-1 text-[16px] font-semibold text-[#242a43]">
                        {{ profileRole }}
                    </p>
                </div>
            </article>

            <div>
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#232743] md:text-[30px]"
                >
                    {{ title }}
                </h2>
                <p
                    class="mt-5 text-[15px] leading-[1.7] text-[#66708b] md:text-[16px]"
                >
                    {{ description }}
                </p>

                <ul class="mt-8 grid gap-4 sm:grid-cols-2">
                    <li
                        v-for="point in points"
                        :key="point"
                        class="inline-flex items-start gap-3 text-[14px] leading-[1.6] font-semibold text-[#2c3149] md:text-[15px]"
                    >
                        <CheckCircle2
                            :size="20"
                            :class="[
                                'mt-[1px] shrink-0',
                                isBrandTheme
                                    ? 'text-[#de8a00]'
                                    : isRedTheme
                                      ? 'text-[#d65858]'
                                      : 'text-[#4d98df]',
                            ]"
                        />
                        <span>{{ point }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <Teleport to="body">
            <div
                v-if="isModalOpen"
                class="fixed inset-0 z-[120] flex items-center justify-center bg-black/65 p-4"
                role="dialog"
                aria-modal="true"
                @click.self="closeModal"
            >
                <div
                    class="relative w-[min(860px,96vw)] rounded-sm border border-white/50 bg-white p-4 shadow-[0_20px_50px_rgba(0,0,0,0.35)]"
                >
                    <button
                        type="button"
                        class="absolute top-3 right-3 inline-flex h-8 w-8 items-center justify-center rounded-full text-[#2a2f46] transition-colors hover:bg-[#eef3f8]"
                        aria-label="Tutup modal"
                        @click="closeModal"
                    >
                        <X :size="24" />
                    </button>

                    <div class="mx-auto w-[min(420px,100%)]">
                        <div
                            class="overflow-hidden border border-[#dce8f3] bg-white"
                        >
                            <iframe
                                class="aspect-[9/16] w-full"
                                :src="videoEmbedUrl"
                                title="Cerita Founder Frametech"
                                allow="
                                    accelerometer;
                                    autoplay;
                                    clipboard-write;
                                    encrypted-media;
                                    gyroscope;
                                    picture-in-picture;
                                    web-share;
                                "
                                allowfullscreen
                            />
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>
    </section>
</template>
