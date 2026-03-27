<script setup lang="ts">
import { BriefcaseBusiness, Headphones, Store } from 'lucide-vue-next';

const reasons = [
    {
        icon: BriefcaseBusiness,
        title: 'Berpengalaman Lebih dari 7 Tahun',
        description:
            'Kami memiliki pengalaman membangun berbagai website untuk kebutuhan bisnis lokal di berbagai industri.',
    },
    {
        icon: Store,
        title: 'Fokus untuk UMKM Indonesia',
        description:
            'Kami percaya bisnis lokal berhak punya website yang rapi, efektif, dan relevan dengan target pasarnya.',
    },
    {
        icon: Headphones,
        title: 'Konsultasi dan Dukungan Penuh',
        description:
            'Kami membantu dari tahap konsep, perencanaan, sampai website siap digunakan oleh bisnismu.',
    },
];
</script>

<template>
    <section
        class="bg-[linear-gradient(180deg,#f5f9fd_0%,#fff8ea_100%)] py-24 md:py-28"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[760px] text-center">
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]"
                >
                    Kenapa Harus Frametech?
                </h2>
                <p
                    class="mx-auto mt-5 max-w-[720px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]"
                >
                    Kami hadir untuk mendampingi bisnis lokal naik kelas secara
                    digital dengan pendekatan yang praktis dan relevan.
                </p>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                <article
                    v-for="reason in reasons"
                    :key="reason.title"
                    class="rounded-[24px] border border-[#dce8f4] bg-white px-7 py-9 text-center shadow-[0_14px_26px_rgba(31,91,143,0.08)]"
                >
                    <span
                        class="mx-auto grid h-[66px] w-[66px] place-items-center rounded-full bg-gradient-to-b from-[#2c87c9] to-[#176aaf] text-white shadow-[0_12px_22px_rgba(36,110,169,0.18)]"
                    >
                        <component :is="reason.icon" :size="28" />
                    </span>
                    <h3
                        class="mt-6 text-[17px] leading-[1.4] font-semibold text-[#2a2e49] md:text-[18px]"
                    >
                        {{ reason.title }}
                    </h3>
                    <p
                        class="mt-4 text-[14px] leading-[1.75] text-[#6e7691] md:text-[15px]"
                    >
                        {{ reason.description }}
                    </p>
                </article>
            </div>
        </div>
    </section>
</template>
