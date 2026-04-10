<?php

namespace App\Http\Requests\Settings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SiteSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'siteName' => ['required', 'string', 'max:255'],
            'companyDescription' => ['required', 'string', 'max:1500'],
            'phoneNumber' => ['required', 'string', 'max:50'],
            'whatsappNumber' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'businessHours' => ['nullable', 'string', 'max:255'],
            'instagramUrl' => ['nullable', 'url', 'max:255'],
            'facebookUrl' => ['nullable', 'url', 'max:255'],
            'linkedinUrl' => ['nullable', 'url', 'max:255'],
            'tiktokUrl' => ['nullable', 'url', 'max:255'],
            'youtubeUrl' => ['nullable', 'url', 'max:255'],
            'copyrightName' => ['nullable', 'string', 'max:255'],
            'seoTitle' => ['nullable', 'string', 'max:255'],
            'seoDescription' => ['nullable', 'string', 'max:320'],
            'seoKeywords' => ['nullable', 'string', 'max:1000'],
            'seoLocality' => ['nullable', 'string', 'max:100'],
            'seoRegion' => ['nullable', 'string', 'max:100'],
            'seoFocusKeyword' => ['nullable', 'string', 'max:255'],
            'businessTypesSlides' => ['nullable', 'array', 'max:10'],
            'businessTypesSlides.*.title' => ['required', 'string', 'max:120'],
            'businessTypesSlides.*.imageUrl' => ['required', 'url', 'max:2048'],
            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png,svg,webp', 'max:1024'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_favicon' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'siteName.required' => 'Nama situs wajib diisi.',
            'companyDescription.required' => 'Deskripsi perusahaan wajib diisi.',
            'phoneNumber.required' => 'Nomor telepon wajib diisi.',
            'whatsappNumber.required' => 'Nomor WhatsApp wajib diisi.',
            'email.email' => 'Email harus valid.',
            'instagramUrl.url' => 'Link Instagram harus berupa URL yang valid.',
            'facebookUrl.url' => 'Link Facebook harus berupa URL yang valid.',
            'linkedinUrl.url' => 'Link LinkedIn harus berupa URL yang valid.',
            'tiktokUrl.url' => 'Link TikTok harus berupa URL yang valid.',
            'youtubeUrl.url' => 'Link YouTube harus berupa URL yang valid.',
            'seoDescription.max' => 'Meta description SEO maksimal 320 karakter.',
            'businessTypesSlides.max' => 'Maksimal 10 slide untuk section jenis bisnis.',
            'businessTypesSlides.*.title.required' => 'Judul slide wajib diisi.',
            'businessTypesSlides.*.imageUrl.required' => 'URL gambar slide wajib diisi.',
            'businessTypesSlides.*.imageUrl.url' => 'URL gambar slide harus valid.',
            'logo.mimes' => 'Logo harus berupa file JPG, PNG, WEBP, atau SVG.',
            'favicon.mimes' => 'Favicon harus berupa file ICO, PNG, SVG, atau WEBP.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'remove_logo' => $this->boolean('remove_logo'),
            'remove_favicon' => $this->boolean('remove_favicon'),
            'businessTypesSlides' => collect($this->input('businessTypesSlides', []))
                ->filter(fn (mixed $slide): bool => is_array($slide))
                ->map(fn (array $slide): array => [
                    'title' => trim((string) ($slide['title'] ?? '')),
                    'imageUrl' => trim((string) ($slide['imageUrl'] ?? '')),
                ])
                ->values()
                ->all(),
        ]);
    }
}
