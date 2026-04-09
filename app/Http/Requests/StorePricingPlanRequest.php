<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePricingPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:pricing_plans,slug'],
            'summary' => ['required', 'string', 'max:1000'],
            'previous_price' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'string', 'max:50'],
            'discount_label' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:255'],
            'cta_label' => ['required', 'string', 'max:80'],
            'featuresText' => ['required', 'string'],
            'features' => ['required', 'array', 'min:3'],
            'features.*' => ['required', 'string', 'max:255'],
            'icon_letter' => ['required', 'string', 'max:2'],
            'accent_tone' => ['required', 'string', 'in:bronze,silver,gold,blue'],
            'sort_order' => ['required', 'integer', 'min:1', 'max:999'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda minus.',
            'features.min' => 'Minimal isi 3 fitur paket.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $featuresText = (string) $this->input('featuresText', '');

        $this->merge([
            'features' => collect(preg_split('/\r\n|\r|\n/', $featuresText) ?: [])
                ->map(fn (string $feature): string => trim($feature))
                ->filter()
                ->values()
                ->all(),
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active', true),
        ]);
    }
}
