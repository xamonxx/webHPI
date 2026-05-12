<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PortfolioRequest extends FormRequest
{
    private const MAX_PHOTOS = 5;

    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    protected function prepareForValidation(): void
    {
        $category = $this->input('category');

        if (is_string($category)) {
            $category = trim(preg_replace('/\s+/', ' ', $category));
        }

        $this->merge([
            'category' => $category === '' ? null : $category,
        ]);
    }

    public function rules(): array
    {
        $photoRules = $this->isMethod('post')
            ? ['required', 'array', 'min:1', 'max:'.self::MAX_PHOTOS]
            : ['nullable', 'array', 'max:'.self::MAX_PHOTOS];

        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'photos' => $photoRules,
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'existing_photos' => ['nullable', 'array', 'max:'.self::MAX_PHOTOS],
            'existing_photos.*' => ['integer'],
            'removed_photos' => ['nullable', 'array', 'max:'.self::MAX_PHOTOS],
            'removed_photos.*' => ['integer'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'photos.required' => 'Minimal 1 foto portfolio wajib diupload.',
            'photos.min' => 'Minimal 1 foto portfolio wajib diupload.',
            'photos.max' => 'Maksimal upload '.self::MAX_PHOTOS.' foto portfolio.',
            'photos.*.image' => 'Foto wajib berupa gambar.',
            'photos.*.mimes' => 'Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.',
            'photos.*.max' => 'Maksimal ukuran setiap foto adalah 10 MB.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $photos = $this->file('photos', []);

            if ($this->hasFile('photos') && ! is_array($photos)) {
                $validator->errors()->add('photos', 'Format upload foto tidak valid.');

                return;
            }

            if (is_array($photos) && count($photos) > self::MAX_PHOTOS) {
                $validator->errors()->add('photos', 'Maksimal upload '.self::MAX_PHOTOS.' foto portfolio.');
            }

            foreach ((array) $photos as $photo) {
                if ($photo && $photo->getSize() > 10 * 1024 * 1024) {
                    $validator->errors()->add('photos', 'Ada foto yang melebihi batas 10 MB.');
                    break;
                }
            }
        });
    }
}
