<?php

namespace App\Models;

use Database\Factories\SiteSettingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    /** @use HasFactory<SiteSettingFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'site_name',
        'company_description',
        'phone_number',
        'whatsapp_number',
        'email',
        'address',
        'business_hours',
        'instagram_url',
        'facebook_url',
        'linkedin_url',
        'tiktok_url',
        'youtube_url',
        'copyright_name',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_locality',
        'seo_region',
        'seo_focus_keyword',
        'logo_path',
        'favicon_path',
        'business_types_slides',
    ];

    /**
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'site_name' => 'Frametech',
            'company_description' => 'Frametech adalah layanan jasa pembuatan website profesional untuk UMKM dan bisnis lokal. Kami membantu brand tampil lebih rapi, mudah dipercaya, dan siap berkembang melalui website yang terstruktur dan mudah digunakan.',
            'phone_number' => '08986650404',
            'whatsapp_number' => '628986650404',
            'email' => 'hello@frametech.test',
            'address' => 'Makassar, Sulawesi Selatan',
            'business_hours' => 'Setiap Hari, 09.00 - 21.00 WITA',
            'instagram_url' => null,
            'facebook_url' => null,
            'linkedin_url' => null,
            'tiktok_url' => null,
            'youtube_url' => null,
            'copyright_name' => 'PT. Global Creative Labs',
            'seo_title' => 'Frametech | Jasa Pembuatan Website & Aplikasi Makassar',
            'seo_description' => 'Frametech melayani jasa pembuatan website dan aplikasi untuk bisnis di Makassar. Cocok untuk UMKM, company profile, landing page promosi, dan sistem internal yang rapi, cepat, dan SEO-friendly.',
            'seo_keywords' => 'jasa pembuatan aplikasi makassar, jasa pembuatan website makassar, website company profile makassar, jasa buat aplikasi bisnis makassar, jasa website umkm makassar',
            'seo_locality' => 'Makassar',
            'seo_region' => 'Sulawesi Selatan',
            'seo_focus_keyword' => 'Jasa Pembuatan Aplikasi Makassar',
            'logo_path' => null,
            'favicon_path' => null,
            'business_types_slides' => static::defaultBusinessTypesSlides(),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'business_types_slides' => 'array',
        ];
    }

    public static function current(): self
    {
        if (! Schema::hasTable('site_settings')) {
            return new self(static::defaults());
        }

        return static::query()->firstOrCreate(
            ['id' => 1],
            static::defaults(),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function publicData(): array
    {
        $assetVersion = $this->assetVersion();

        return [
            'siteName' => $this->site_name,
            'companyDescription' => $this->company_description,
            'phoneNumber' => $this->phone_number,
            'whatsappNumber' => $this->whatsapp_number,
            'whatsappUrl' => $this->whatsapp_number
                ? 'https://wa.me/'.preg_replace('/\D+/', '', $this->whatsapp_number)
                : '#contact',
            'email' => $this->email,
            'address' => $this->address,
            'businessHours' => $this->business_hours,
            'instagramUrl' => $this->instagram_url,
            'facebookUrl' => $this->facebook_url,
            'linkedinUrl' => $this->linkedin_url,
            'tiktokUrl' => $this->tiktok_url,
            'youtubeUrl' => $this->youtube_url,
            'copyrightName' => $this->copyright_name,
            'seoTitle' => $this->seo_title,
            'seoDescription' => $this->seo_description,
            'seoKeywords' => $this->seo_keywords,
            'seoLocality' => $this->seo_locality,
            'seoRegion' => $this->seo_region,
            'seoFocusKeyword' => $this->seo_focus_keyword,
            'logoUrl' => route('site-assets.show', ['asset' => 'logo', 'v' => $assetVersion]),
            'faviconUrl' => route('site-assets.show', ['asset' => 'favicon', 'v' => $assetVersion]),
            'businessTypesSlides' => $this->businessTypesSlides(),
            'faviconMime' => $this->faviconMime(),
        ];
    }

    /**
     * @return list<string>
     */
    public function seoKeywordList(): array
    {
        return collect(explode(',', (string) $this->seo_keywords))
            ->map(fn (string $keyword): string => trim($keyword))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * @param  list<string>  $keywords
     * @param  list<array<string, mixed>>  $schema
     * @return array<string, mixed>
     */
    public function seoData(
        string $title,
        string $description,
        string $canonical,
        array $keywords = [],
        array $schema = [],
    ): array {
        return [
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'keywords' => collect([
                ...$this->seoKeywordList(),
                ...$keywords,
            ])->filter()->unique()->values()->all(),
            'ogImage' => route('site-assets.show', ['asset' => 'logo', 'v' => $this->updated_at?->timestamp]),
            'schema' => $schema,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function defaultSeo(): array
    {
        return $this->seoData(
            $this->seo_title ?? "{$this->site_name} | Jasa Pembuatan Website & Aplikasi Makassar",
            $this->seo_description ?? $this->company_description,
            url()->current(),
            [$this->seo_focus_keyword],
            [$this->localBusinessSchema()],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function localBusinessSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $this->site_name,
            'description' => $this->seo_description ?? $this->company_description,
            'url' => route('home'),
            'telephone' => $this->phone_number,
            'image' => route('site-assets.show', ['asset' => 'logo', 'v' => $this->updated_at?->timestamp]),
            'email' => $this->email,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $this->address,
                'addressLocality' => $this->seo_locality,
                'addressRegion' => $this->seo_region,
                'addressCountry' => 'ID',
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => $this->seo_locality,
            ],
            'sameAs' => collect([
                $this->instagram_url,
                $this->facebook_url,
                $this->linkedin_url,
                $this->tiktok_url,
                $this->youtube_url,
            ])->filter()->values()->all(),
        ];
    }

    private function assetVersion(): string
    {
        $updatedAt = $this->updated_at?->format('Uu') ?? '0';

        return hash('xxh128', implode('|', [
            $updatedAt,
            $this->logo_path ?? 'no-logo',
            $this->favicon_path ?? 'no-favicon',
            json_encode($this->businessTypesSlides()),
        ]));
    }

    private function faviconMime(): string
    {
        return match (strtolower(pathinfo((string) $this->favicon_path, PATHINFO_EXTENSION))) {
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'webp' => 'image/webp',
            default => 'image/x-icon',
        };
    }

    /**
     * @return list<array{title: string, imageUrl: string}>
     */
    private function businessTypesSlides(): array
    {
        $slides = collect($this->business_types_slides ?? static::defaultBusinessTypesSlides())
            ->filter(fn (mixed $slide): bool => is_array($slide))
            ->map(function (array $slide): array {
                return [
                    'title' => trim((string) ($slide['title'] ?? '')),
                    'imageUrl' => trim((string) ($slide['imageUrl'] ?? $slide['image_url'] ?? '')),
                ];
            })
            ->filter(fn (array $slide): bool => $slide['title'] !== '' && filter_var($slide['imageUrl'], FILTER_VALIDATE_URL) !== false)
            ->values()
            ->all();

        return $slides !== [] ? $slides : static::defaultBusinessTypesSlides();
    }

    /**
     * @return list<array{title: string, imageUrl: string}>
     */
    private static function defaultBusinessTypesSlides(): array
    {
        return [
            [
                'title' => 'Interior',
                'imageUrl' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Produk',
                'imageUrl' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Hospitality',
                'imageUrl' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Portfolio',
                'imageUrl' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Company',
                'imageUrl' => 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1600&q=80',
            ],
        ];
    }
}
