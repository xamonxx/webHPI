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

    public function rules(): array
    {
        $photoRules = $this->isMethod('post')
            ? ['required', 'array', 'min:1', 'max:' . self::MAX_PHOTOS]
            : ['nullable', 'array', 'max:' . self::MAX_PHOTOS];

        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'photos' => $photoRules,
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'existing_photos' => ['nullable', 'array', 'max:' . self::MAX_PHOTOS],
            'existing_photos.*' => ['integer'],
            'removed_photos' => ['nullable', 'array', 'max:' . self::MAX_PHOTOS],
            'removed_photos.*' => ['integer'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'photos.array' => 'Maksimal upload 5 foto.',
            'photos.required' => 'Foto wajib berupa gambar.',
            'photos.min' => 'Foto wajib berupa gambar.',
            'photos.max' => 'Maksimal upload 5 foto.',
            'photos.*.image' => 'Foto wajib berupa gambar.',
            'photos.*.mimes' => 'Format gambar tidak didukung. Gunakan JPG, JPEG, PNG, atau WEBP.',
            'photos.*.max' => 'Maksimal ukuran setiap foto adalah 10 MB.',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $photos = $this->file('photos', []);
            $photoCount = is_array($photos) ? count($photos) : 0;

            if ($this->hasFile('photos') && !is_array($photos)) {
                $validator->errors()->add('photos', 'Maksimal upload 5 foto.');
                return;
            }

            if ($photoCount > self::MAX_PHOTOS) {
                $validator->errors()->add('photos', 'Maksimal upload 5 foto.');
            }

            foreach ($photos as $photo) {
                if ($photo && $photo->getSize() > 10 * 1024 * 1024) {
                    $validator->errors()->add('photos', 'Ada foto yang melebihi batas 10 MB.');
                    break;
                }
            }
        });
    }
}
