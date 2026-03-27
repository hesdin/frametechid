<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
  ArrowLeft,
  Facebook,
  Link2,
  Linkedin,
  Send,
  UserRound,
} from 'lucide-vue-next';
import CTA from '@/components/landing/CTA.vue';
import Footer from '@/components/landing/Footer.vue';
import Navbar from '@/components/landing/Navbar.vue';
import { findBlogPost } from '@/data/blog';
import LandingLayout from '@/layouts/LandingLayout.vue';
import { blog } from '@/routes';
import { show } from '@/routes/blog';

const props = defineProps<{
  slug: string;
}>();

const post =
  findBlogPost(props.slug) ??
  findBlogPost(
    'pembuatan-website-umkm-cara-bisnis-lokal-scale-up-dan-perluas-market-di-2026',
  )!;

const articlePath = show({ slug: post.slug }).url;
const articleUrl =
  typeof window !== 'undefined'
    ? `${window.location.origin}${articlePath}`
    : articlePath;

const shareLinks = [
  {
    label: 'Copy Link',
    href: articleUrl,
    icon: Link2,
  },
  {
    label: 'Facebook',
    href: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(articleUrl)}`,
    icon: Facebook,
  },
  {
    label: 'LinkedIn',
    href: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(articleUrl)}`,
    icon: Linkedin,
  },
  {
    label: 'Telegram',
    href: `https://t.me/share/url?url=${encodeURIComponent(articleUrl)}&text=${encodeURIComponent(post.title)}`,
    icon: Send,
  },
];
</script>

<template>

  <Head :title="`${post.title} | Frametech`">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet" />
  </Head>

  <LandingLayout>
    <Navbar current-page="blog" theme="red" />
    <main class="bg-white">
      <section class="py-12 md:py-16">
        <div
          class="mx-auto w-[min(1280px,calc(100%-1.5rem))] md:w-[min(1280px,calc(100%-2.5rem))] lg:w-[min(1280px,calc(100%-12rem))]">
          <div>
            <Link :href="blog().url"
              class="inline-flex items-center gap-2 text-[14px] text-[#7a839a] transition-colors hover:text-[#2f334e]">
              <ArrowLeft :size="16" />
              <span>Kembali</span>
            </Link>

            <div class="mt-8 text-center">
              <h1
                class="mx-auto max-w-[760px] text-[28px] leading-[1.45] font-semibold tracking-[-0.03em] text-[#2f334e] md:text-[40px]">
                {{ post.title }}
              </h1>
              <p class="mt-4 text-[15px] text-[#8a90a7]">
                {{ post.date }}
              </p>
            </div>

            <div class="mt-10 overflow-hidden rounded-[24px] bg-[#f3f4f7]">
              <img :src="post.image" :alt="post.title" class="h-[260px] w-full object-cover md:h-[520px]" />
            </div>
          </div>

          <div class="mt-12 grid gap-8 lg:grid-cols-[72px_minmax(0,1fr)]">
            <aside class="hidden lg:block">
              <div class="sticky top-28">
                <p class="text-[12px] font-semibold tracking-[0.18em] text-[#99a0b5] uppercase">
                  Share
                </p>
                <div class="mt-4 grid gap-3">
                  <a v-for="item in shareLinks" :key="item.label" :href="item.href"
                    :target="item.label === 'Copy Link' ? undefined : '_blank'"
                    :rel="item.label === 'Copy Link' ? undefined : 'noopener noreferrer'" :aria-label="item.label"
                    class="grid h-11 w-11 place-items-center rounded-full border border-[#e2e7ef] bg-white text-[#5d6b85] transition-colors hover:border-[#d85b5b] hover:text-[#d85b5b]">
                    <component :is="item.icon" :size="18" />
                  </a>
                </div>
              </div>
            </aside>

            <article class="min-w-0">
              <div class="flex items-start gap-4">
                <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-[#d85b5b] text-white">
                  <UserRound :size="20" />
                </span>
                <div class="text-[14px] leading-[1.85] text-[#4f586e] md:text-[16px]">
                  <p class="font-semibold text-[#2f334e]">
                    Halo Sobat Frametech!
                  </p>
                  <p class="mt-3">
                    Di tahun 2026, cara bisnis lokal berkembang
                    berubah semakin cepat. Bukan cuma soal
                    produk atau layanan yang bagus, sekarang
                    pelanggan juga menilai brand dari seberapa
                    profesional tampilannya di internet.
                  </p>
                  <p class="mt-3">
                    Itulah kenapa memiliki website bukan lagi
                    sekadar pelengkap, tetapi fondasi penting
                    agar bisnis punya citra yang lebih kuat,
                    mudah ditemukan, dan siap menjangkau pasar
                    yang lebih luas.
                  </p>
                </div>
              </div>

              <div class="mt-10 space-y-8 text-[#434b61]">
                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Perubahan Perilaku Konsumen di Era Digital
                  </h2>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Konsumen mencari informasi lewat Google
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Sebelum membeli, mereka hampir selalu
                    mencari informasi lebih dulu. Jika bisnis
                    belum punya website, peluang untuk tampil di
                    hasil pencarian jadi jauh lebih kecil.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Website membuat bisnis lebih kredibel
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Ketika calon pelanggan menemukan website
                    yang rapi, jelas, dan mudah digunakan,
                    kepercayaan terhadap brand biasanya naik
                    secara signifikan.
                  </p>
                </section>

                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Kenapa Pembuatan Website UMKM Penting untuk
                    Scale Up
                  </h2>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Menjangkau market lebih luas
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Website membuka kesempatan untuk bisnis
                    dikenal bukan hanya oleh pelanggan sekitar,
                    tetapi juga oleh calon pelanggan baru dari
                    area yang lebih luas.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Meningkatkan kepercayaan pelanggan
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Tampilan yang informatif, profesional, dan
                    terstruktur membantu bisnis terlihat lebih
                    siap, lebih serius, dan lebih layak dipilih.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Membantu proses closing lebih cepat
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Saat informasi utama sudah tersedia di
                    website, calon pelanggan bisa mengambil
                    keputusan lebih cepat tanpa harus bertanya
                    dari nol.
                  </p>
                </section>

                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Manfaat Website untuk Bisnis Lokal
                  </h2>
                  <ol class="mt-5 list-decimal space-y-4 pl-5 text-[15px] leading-[1.85]">
                    <li>
                      Bisa jadi katalog produk atau layanan
                      yang selalu aktif 24 jam.
                    </li>
                    <li>
                      Membantu edukasi pelanggan sebelum
                      mereka menghubungi bisnis.
                    </li>
                    <li>
                      Membuat bisnis terlihat lebih serius,
                      terpercaya, dan siap berkembang.
                    </li>
                  </ol>
                </section>

                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Contoh UMKM yang Naik Level Dengan Website
                  </h2>
                  <p class="mt-5 text-[15px] leading-[1.85]">
                    Beberapa jenis bisnis lokal yang sering
                    terlihat lebih premium setelah punya
                    website:
                  </p>
                  <ul class="mt-4 list-disc space-y-3 pl-5 text-[15px] leading-[1.85]">
                    <li>Cafe & restaurant untuk tampil lebih profesional.</li>
                    <li>Klinik dan layanan jasa supaya mudah dipercaya pelanggan.</li>
                    <li>Property dan travel agar penawaran lebih tertata.</li>
                    <li>Fashion dan brand lokal untuk katalog digital yang rapi.</li>
                  </ul>
                </section>

                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Tips Memilih Website yang Tepat Untuk Bisnis
                    UMKM
                  </h2>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Mobile-first design
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Pastikan website nyaman dibuka dari HP karena
                    mayoritas pengunjung datang dari perangkat
                    mobile.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Fast loading
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Website yang cepat membantu pengalaman
                    pengguna tetap baik dan mengurangi risiko
                    pengunjung keluar terlalu cepat.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    SEO friendly
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Struktur yang baik membantu website lebih
                    mudah ditemukan di hasil pencarian Google.
                  </p>
                </section>

                <section>
                  <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                    Solusi Website Siap Pakai untuk UMKM yang
                    Ingin Scale Up
                  </h2>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Paket Website untuk UMKM
                  </h3>
                  <p class="mt-3 text-[15px] leading-[1.85]">
                    Solusi ini cocok untuk pelaku usaha yang
                    ingin punya website tanpa proses yang rumit,
                    tetapi tetap terlihat rapi, profesional, dan
                    siap dipakai untuk promosi.
                  </p>
                  <h3 class="mt-5 text-[17px] font-semibold text-[#2f334e]">
                    Fitur yang wajib dimiliki website UMKM
                  </h3>
                  <ul class="mt-4 list-disc space-y-3 pl-5 text-[15px] leading-[1.85]">
                    <li>Halaman utama yang menjelaskan bisnis.</li>
                    <li>Daftar layanan atau katalog produk.</li>
                    <li>Profil bisnis.</li>
                    <li>Informasi kontak.</li>
                    <li>WhatsApp CTA.</li>
                    <li>SEO dasar.</li>
                  </ul>
                </section>
              </div>

              <div
                class="mt-12 overflow-hidden rounded-[24px] bg-[linear-gradient(180deg,#fff0f0_0%,#f9dddd_100%)] px-7 py-8 md:px-9">
                <div class="grid items-center gap-8 lg:grid-cols-[0.9fr_1.1fr]">
                  <div>
                    <h3 class="text-[24px] leading-[1.35] font-semibold text-[#2f334e]">
                      Yuk bawa bisnis kamu Go Digital bareng
                      Frametech
                    </h3>
                    <p class="mt-4 text-[15px] leading-[1.75] text-[#60708b]">
                      Konsultasi gratis dan cari paket website
                      yang paling sesuai untuk kebutuhanmu.
                    </p>
                    <a href="#contact"
                      class="mt-6 inline-flex items-center justify-center rounded-[12px] border border-[#cf4a4a] bg-gradient-to-b from-[#f16b6b] to-[#d64040] px-6 py-3 text-[15px] font-semibold text-white shadow-[0_3px_0_0_rgba(167,46,46,0.9)_inset]">
                      Konsultasi Gratis Sekarang
                    </a>
                  </div>

                  <div class="relative min-h-[210px]">
                    <img
                      src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80"
                      alt="Website UMKM"
                      class="absolute left-8 bottom-0 h-[180px] w-[260px] rounded-[16px] border border-white/70 object-cover shadow-[0_14px_24px_rgba(26,70,112,0.2)] md:h-[220px] md:w-[330px]" />
                    <img
                      src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=900&q=80"
                      alt="Website mobile"
                      class="absolute right-5 top-2 h-[130px] w-[82px] rounded-[16px] border border-white/75 object-cover shadow-[0_14px_24px_rgba(26,70,112,0.2)] md:h-[165px] md:w-[105px]" />
                  </div>
                </div>
              </div>


              <section class="mt-12">
                <h2 class="text-[22px] leading-tight font-semibold text-[#2f334e]">
                  Kesimpulan
                </h2>
                <p class="mt-5 text-[15px] leading-[1.85] text-[#434b61]">
                  Pembuatan website untuk UMKM bukan lagi sekadar
                  pelengkap, melainkan fondasi penting untuk
                  membuat bisnis terlihat lebih profesional,
                  mudah ditemukan, dan siap scale up di era
                  digital sekarang. Dengan website yang rapi,
                  bisnis punya ruang lebih besar untuk membangun
                  kepercayaan dan memperluas pasar.
                </p>
              </section>

              <div class="mt-10 flex flex-wrap gap-3">
                <span v-for="tag in post.tags" :key="tag"
                  class="rounded-full border border-[#e4e8ef] bg-white px-4 py-2 text-[13px] text-[#66708a]">
                  {{ tag }}
                </span>
              </div>
            </article>
          </div>
        </div>
      </section>

      <CTA title="Siap Tampil Lebih Profesional Secara Online?"
        description="Mulai dari website yang tepat dan biarkan kami bantu bisnis kamu makin percaya diri di dunia online."
        theme="red" />
    </main>
    <Footer theme="red" />
  </LandingLayout>
</template>
