<script setup lang="ts">
const projects = [
    {
        title: 'Serata Engineering',
        desktopImage:
            'https://images.unsplash.com/photo-1557682250-33bd709cbe85?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1598128558393-70ff21433be0?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Coral Cafe',
        desktopImage:
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Sekolah Harapan',
        desktopImage:
            'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Azura Resort',
        desktopImage:
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Kopi Karya',
        desktopImage:
            'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Harmoni Clinic',
        desktopImage:
            'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Senada Partners',
        desktopImage:
            'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Sky Resort',
        desktopImage:
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Trailway Journey',
        desktopImage:
            'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Atelier Boutique',
        desktopImage:
            'https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Ubud Eco Escape',
        desktopImage:
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=900&q=80',
    },
    {
        title: 'Terra Interior',
        desktopImage:
            'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1800&q=80',
        mobileImage:
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
    },
];
</script>

<template>
    <section
        id="portfolio"
        class="bg-[linear-gradient(180deg,#ffffff_0%,#f5f9fd_100%)] py-20 md:py-24"
    >
        <div
            class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]"
        >
            <div class="mx-auto max-w-[920px] text-center">
                <h2
                    class="text-[18px] leading-tight font-bold tracking-[-0.02em] text-[#272a45] md:text-[30px]"
                >
                    Project Website yang Sudah Kami Kerjakan
                </h2>
                <p
                    class="mx-auto mt-5 max-w-[820px] text-[15px] leading-[1.7] text-[#6d7390] md:text-[16px]"
                >
                    Beberapa contoh website dari berbagai industri untuk
                    menunjukkan gaya visual, struktur, dan kualitas eksekusi
                    yang bisa kami bantu bangun untuk bisnismu.
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2">
                <article
                    v-for="project in projects"
                    :key="project.title"
                    class="group"
                >
                    <div
                        class="overflow-hidden rounded-[22px] border border-[#dce8f4] bg-[#eef5fb] px-4 pt-4 shadow-[0_14px_26px_rgba(31,91,143,0.08)] md:px-5 md:pt-5"
                    >
                        <div class="relative h-[220px] md:h-[260px]">
                            <img
                                :src="project.desktopImage"
                                :alt="`${project.title} desktop`"
                                class="absolute inset-y-0 left-0 h-full w-[78%] rounded-[10px] border border-black/5 object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                            />
                            <img
                                :src="project.mobileImage"
                                :alt="`${project.title} mobile`"
                                class="absolute top-0 right-0 h-full w-[24%] rounded-[10px] border border-black/10 object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                            />
                        </div>
                    </div>

                    <div class="px-1 pt-4">
                        <h3
                            class="text-[17px] leading-[1.35] font-semibold tracking-[-0.01em] text-[#2a2e49] md:text-[18px]"
                        >
                            {{ project.title }}
                        </h3>
                    </div>
                </article>
            </div>
        </div>
    </section>
</template>
