<script setup lang="ts">
const packages = [
    {
        name: 'Paket UMKM',
        description:
            'Untuk bisnis yang ingin mulai tampil profesional dengan struktur website yang ringkas dan jelas.',
        accent: 'from-[#f4dfc9] to-[#c48943]',
        icon: 'U',
    },
    {
        name: 'Paket Menengah',
        description:
            'Untuk brand yang membutuhkan halaman lebih lengkap, konten lebih banyak, dan tampilan lebih detail.',
        accent: 'from-[#f2f2f3] to-[#a5a8af]',
        icon: 'M',
    },
    {
        name: 'Paket Premium',
        description:
            'Untuk kebutuhan presentasi brand yang lebih kuat dengan struktur, visual, dan pengalaman yang lebih eksklusif.',
        accent: 'from-[#f2db89] to-[#d2a323]',
        icon: 'P',
    },
];
</script>

<template>
    <section
        id="harga"
        class="bg-[linear-gradient(180deg,#fff8ea_0%,#f3f9fd_100%)] py-24 md:py-28"
    >
        <div
            class="mx-auto grid w-[min(1280px,calc(100%-1.5rem))] items-center gap-10 md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))] lg:grid-cols-[0.9fr_1.1fr]"
        >
            <div class="max-w-[570px]">
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]"
                >
                    Harga Pembuatan Website di Frametech
                </h2>
                <p
                    class="mt-5 text-[15px] leading-[1.75] text-[#6d7390] md:text-[16px]"
                >
                    Kami menyiapkan beberapa kategori paket untuk memudahkan
                    bisnis memilih kebutuhan website yang paling sesuai dengan
                    target dan tahap pertumbuhannya.
                </p>

                <div class="mt-8">
                    <a
                        href="#contact"
                        class="inline-flex items-center justify-center rounded-[10px] border border-[#c97f00] bg-gradient-to-b from-[#eda40f] to-[#d98700] px-7 py-[11px] text-[14px] font-semibold text-white shadow-[0_3px_0_0_rgba(167,103,0,0.85)_inset]"
                    >
                        Konsultasi Harga
                    </a>
                </div>
            </div>

            <div
                class="rounded-[28px] bg-[linear-gradient(180deg,#eef7fd_0%,#fff3da_100%)] p-5 md:p-7"
            >
                <div class="grid gap-4">
                    <article
                        v-for="item in packages"
                        :key="item.name"
                        class="flex items-start gap-4 rounded-[20px] border border-[#dde8f2] bg-white px-5 py-5 shadow-[0_10px_20px_rgba(25,70,110,0.06)]"
                    >
                        <span
                            :class="[
                                'grid h-[54px] w-[54px] shrink-0 place-items-center rounded-full bg-gradient-to-b text-[20px] font-semibold text-[#5c4330]',
                                item.accent,
                            ]"
                        >
                            {{ item.icon }}
                        </span>

                        <div>
                            <h3
                                class="text-[16px] font-semibold text-[#2b2f45] md:text-[17px]"
                            >
                                {{ item.name }}
                            </h3>
                            <p
                                class="mt-2 text-[14px] leading-[1.7] text-[#6e7691] md:text-[15px]"
                            >
                                {{ item.description }}
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>
