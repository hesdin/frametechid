<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SiteSettingUpdateRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class SiteSettingController extends Controller
{
    public function edit(): Response
    {
        $siteSetting = SiteSetting::current();

        return Inertia::render('settings/Site', [
            'settings' => [
                'siteName' => $siteSetting->site_name,
                'companyDescription' => $siteSetting->company_description,
                'phoneNumber' => $siteSetting->phone_number,
                'whatsappNumber' => $siteSetting->whatsapp_number,
                'email' => $siteSetting->email,
                'address' => $siteSetting->address,
                'businessHours' => $siteSetting->business_hours,
                'instagramUrl' => $siteSetting->instagram_url,
                'facebookUrl' => $siteSetting->facebook_url,
                'linkedinUrl' => $siteSetting->linkedin_url,
                'tiktokUrl' => $siteSetting->tiktok_url,
                'youtubeUrl' => $siteSetting->youtube_url,
                'copyrightName' => $siteSetting->copyright_name,
                'seoTitle' => $siteSetting->seo_title,
                'seoDescription' => $siteSetting->seo_description,
                'seoKeywords' => $siteSetting->seo_keywords,
                'seoLocality' => $siteSetting->seo_locality,
                'seoRegion' => $siteSetting->seo_region,
                'seoFocusKeyword' => $siteSetting->seo_focus_keyword,
                'logoUrl' => $siteSetting->publicData()['logoUrl'],
                'faviconUrl' => $siteSetting->publicData()['faviconUrl'],
                'businessTypesSlides' => $siteSetting->publicData()['businessTypesSlides'],
            ],
        ]);
    }

    public function update(SiteSettingUpdateRequest $request): RedirectResponse
    {
        $siteSetting = SiteSetting::current();

        $validated = $request->safe()->except([
            'logo',
            'favicon',
            'remove_logo',
            'remove_favicon',
        ]);

        $payload = [
            'site_name' => $validated['siteName'],
            'company_description' => $validated['companyDescription'],
            'phone_number' => $validated['phoneNumber'],
            'whatsapp_number' => $validated['whatsappNumber'],
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'] ?? null,
            'business_hours' => $validated['businessHours'] ?? null,
            'instagram_url' => $validated['instagramUrl'] ?? null,
            'facebook_url' => $validated['facebookUrl'] ?? null,
            'linkedin_url' => $validated['linkedinUrl'] ?? null,
            'tiktok_url' => $validated['tiktokUrl'] ?? null,
            'youtube_url' => $validated['youtubeUrl'] ?? null,
            'copyright_name' => $validated['copyrightName'] ?? null,
            'seo_title' => $validated['seoTitle'] ?? null,
            'seo_description' => $validated['seoDescription'] ?? null,
            'seo_keywords' => $validated['seoKeywords'] ?? null,
            'seo_locality' => $validated['seoLocality'] ?? null,
            'seo_region' => $validated['seoRegion'] ?? null,
            'seo_focus_keyword' => $validated['seoFocusKeyword'] ?? null,
            'business_types_slides' => $this->normalizeBusinessTypeSlides($validated['businessTypesSlides'] ?? []),
        ];

        if ($request->boolean('remove_logo')) {
            $this->deleteAsset($siteSetting->logo_path);
            $payload['logo_path'] = null;
        }

        if ($request->boolean('remove_favicon')) {
            $this->deleteAsset($siteSetting->favicon_path);
            $payload['favicon_path'] = null;
        }

        if ($request->hasFile('logo')) {
            $this->deleteAsset($siteSetting->logo_path);
            $payload['logo_path'] = $request->file('logo')->store('site-settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $this->deleteAsset($siteSetting->favicon_path);
            $payload['favicon_path'] = $request->file('favicon')->store('site-settings', 'public');
        }

        $siteSetting->fill($payload)->save();

        return to_route('site-settings.edit')
            ->with('success', 'Informasi situs berhasil diperbarui.');
    }

    protected function deleteAsset(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * @param  list<array{title?: string, imageUrl?: string}>  $slides
     * @return list<array{title: string, imageUrl: string}>
     */
    protected function normalizeBusinessTypeSlides(array $slides): array
    {
        return collect($slides)
            ->map(fn (array $slide): array => [
                'title' => trim((string) ($slide['title'] ?? '')),
                'imageUrl' => trim((string) ($slide['imageUrl'] ?? '')),
            ])
            ->filter(fn (array $slide): bool => $slide['title'] !== '' && $slide['imageUrl'] !== '')
            ->values()
            ->all();
    }
}
