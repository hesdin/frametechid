<?php

namespace App\Http\Requests;

use App\Concerns\PostValidationRules;
use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
{
    use PostValidationRules;

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
        /** @var Post $post */
        $post = $this->route('post');

        return $this->postRules($post);
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->postMessages();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug((string) $this->input('slug', $this->string('title')->toString())),
        ]);
    }
}
