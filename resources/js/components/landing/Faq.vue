<script setup lang="ts">
withDefaults(
    defineProps<{
        sectionId?: string;
        title?: string;
        description?: string;
    }>(),
    {
        sectionId: 'faq',
        title: 'Pertanyaan yang Sering Diajukan',
        description:
            'Berikut beberapa pertanyaan yang paling sering ditanyakan sebelum memulai pembuatan website bersama Frametech.',
    },
);

const faqs = [
    {
        question: 'Berapa lama proses pembuatan website?',
        answer: 'Rata-rata 5 sampai 10 hari kerja setelah konten dan kebutuhan utama disepakati. Untuk website dengan fitur lebih kompleks, estimasi akan disampaikan di awal proyek.',
    },
    {
        question: 'Apakah bisa dibantu isi konten website juga?',
        answer: 'Ya, kami bisa bantu struktur copywriting dasar untuk hero, layanan, dan CTA agar website langsung siap dipakai promosi.',
    },
    {
        question: 'Apakah website bisa diakses dari HP?',
        answer: 'Semua website dibuat mobile responsive sehingga nyaman dibuka dari smartphone, tablet, maupun desktop.',
    },
    {
        question: 'Apakah sudah termasuk domain dan hosting?',
        answer: 'Paket sudah termasuk setup domain dan hosting sesuai paket yang dipilih. Detailnya ditulis transparan di proposal.',
    },
    {
        question: 'Bagaimana jika saya ingin revisi desain?',
        answer: 'Setiap paket memiliki slot revisi. Anda bisa memberi masukan terarah pada tahap desain dan sebelum website dipublikasikan.',
    },
    {
        question: 'Bisa integrasi WhatsApp dan Google Maps?',
        answer: 'Bisa. Integrasi WhatsApp, Google Maps, dan form kontak merupakan fitur standar untuk kebutuhan UMKM lokal.',
    },
    {
        question: 'Setelah jadi, apakah ada support?',
        answer: 'Ada. Kami tetap mendampingi untuk update minor dan kendala teknis sesuai masa support pada paket yang dipilih.',
    },
    {
        question: 'Apakah bisa bayar bertahap?',
        answer: 'Bisa, skema pembayaran umumnya dua tahap: DP di awal dan pelunasan sebelum go-live. Skema detail akan dijelaskan saat konsultasi.',
    },
];
</script>

<template>
    <section
        :id="sectionId"
        class="bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] py-20 md:py-24"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[880px] text-center">
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#2b2f45] md:text-[30px]"
                >
                    {{ title }}
                </h2>
                <p
                    class="mt-4 text-[15px] leading-7 text-[#787c92] md:text-base"
                >
                    {{ description }}
                </p>
            </div>

            <div class="mt-10 grid gap-6">
                <details
                    v-for="(item, index) in faqs"
                    :key="item.question"
                    :open="index === 0"
                    class="group rounded-[16px] border border-[#dbe8f3] bg-white/90 px-6 py-5 shadow-[0_10px_22px_rgba(39,92,140,0.05)]"
                >
                    <summary
                        class="flex cursor-pointer list-none items-center justify-between gap-6 text-[16px] font-semibold text-[#2c3048] md:text-[17px]"
                    >
                        <span>{{ item.question }}</span>
                        <span
                            class="flex h-7 w-7 items-center justify-center text-[#de8a00]"
                        >
                            <span
                                class="text-[22px] leading-none group-open:hidden"
                            >
                                +
                            </span>
                            <span
                                class="hidden text-[22px] leading-none group-open:block"
                            >
                                -
                            </span>
                        </span>
                    </summary>
                    <p
                        class="mt-4 border-t border-[#e1ebf4] pt-4 text-[14px] leading-7 text-[#6e7388] md:text-[15px]"
                    >
                        {{ item.answer }}
                    </p>
                </details>
            </div>
        </div>
    </section>
</template>
