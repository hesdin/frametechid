<?php

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;

test('authenticated users can view the site settings page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('site-settings.edit'))
        ->assertSuccessful()
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/Site')
            ->has('settings.siteName')
            ->has('settings.logoUrl')
            ->has('settings.faviconUrl')
            ->has('settings.businessTypesSlides')
        );
});

test('authenticated users can update site settings and branding assets', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $logo = UploadedFile::fake()->image('logo.png', 120, 120);
    $favicon = UploadedFile::fake()->image('favicon.png', 64, 64);
    $businessTypesSlides = [
        [
            'title' => 'Website Cafe',
            'imageUrl' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=1200&q=80',
        ],
        [
            'title' => 'Website Klinik',
            'imageUrl' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1200&q=80',
        ],
    ];

    $this->actingAs($user)
        ->post(route('site-settings.update'), [
            'siteName' => 'Acme Studio',
            'companyDescription' => 'Website studio untuk bisnis kreatif lokal yang ingin tampil lebih meyakinkan.',
            'phoneNumber' => '08123456789',
            'whatsappNumber' => '628123456789',
            'email' => 'hello@acmestudio.test',
            'address' => 'Jl. Pengayoman No. 12, Makassar',
            'businessHours' => 'Senin - Sabtu, 09.00 - 18.00 WITA',
            'instagramUrl' => 'https://instagram.com/acmestudio',
            'facebookUrl' => 'https://facebook.com/acmestudio',
            'linkedinUrl' => 'https://linkedin.com/company/acmestudio',
            'tiktokUrl' => 'https://tiktok.com/@acmestudio',
            'youtubeUrl' => 'https://youtube.com/@acmestudio',
            'copyrightName' => 'PT. Acme Studio Digital',
            'seoTitle' => 'Acme Studio | Jasa Pembuatan Aplikasi Makassar',
            'seoDescription' => 'Acme Studio membantu bisnis Makassar memiliki website dan aplikasi yang lebih meyakinkan.',
            'seoKeywords' => 'jasa pembuatan aplikasi makassar, jasa website makassar',
            'seoLocality' => 'Makassar',
            'seoRegion' => 'Sulawesi Selatan',
            'seoFocusKeyword' => 'Jasa Pembuatan Aplikasi Makassar',
            'businessTypesSlides' => $businessTypesSlides,
            'logo' => $logo,
            'favicon' => $favicon,
        ])
        ->assertRedirect(route('site-settings.edit'));

    $siteSetting = SiteSetting::current()->fresh();

    expect($siteSetting->site_name)->toBe('Acme Studio');
    expect($siteSetting->whatsapp_number)->toBe('628123456789');
    expect($siteSetting->instagram_url)->toBe('https://instagram.com/acmestudio');
    expect($siteSetting->seo_focus_keyword)->toBe('Jasa Pembuatan Aplikasi Makassar');
    expect($siteSetting->business_types_slides)->toBe($businessTypesSlides);

    expect($siteSetting->logo_path)->not->toBeNull();
    expect($siteSetting->favicon_path)->not->toBeNull();

    Storage::disk('public')->assertExists($siteSetting->logo_path);
    Storage::disk('public')->assertExists($siteSetting->favicon_path);

    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee(route('site-assets.show', ['asset' => 'favicon']))
        ->assertSee('rel="shortcut icon"', false)
        ->assertInertia(fn (Assert $page) => $page
            ->component('Landing')
            ->where('site.siteName', 'Acme Studio')
            ->where('site.phoneNumber', '08123456789')
            ->where('site.instagramUrl', 'https://instagram.com/acmestudio')
            ->where('site.businessTypesSlides.0.title', $businessTypesSlides[0]['title'])
            ->where('site.businessTypesSlides.0.imageUrl', $businessTypesSlides[0]['imageUrl'])
        );

    $this->get(route('site-assets.show', ['asset' => 'logo']))
        ->assertSuccessful();

    $this->get(route('site-assets.show', ['asset' => 'favicon']))
        ->assertSuccessful();
});

test('favicon asset fallback is served directly without redirect cache artifacts', function () {
    $response = $this->get(route('site-assets.show', ['asset' => 'favicon']));

    $response->assertSuccessful();
    expect((string) $response->headers->get('Cache-Control'))
        ->toContain('no-store')
        ->toContain('no-cache')
        ->toContain('must-revalidate');
    expect($response->headers->get('Location'))->toBeNull();
});
