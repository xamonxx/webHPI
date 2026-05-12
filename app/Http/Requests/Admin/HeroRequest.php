<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'title_highlight' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:1000'],
            'button1_text' => ['nullable', 'string', 'max:50'],
            'button1_link' => ['nullable', 'string', 'max:255', 'not_regex:/^\s*javascript:/i'],
            'button2_text' => ['nullable', 'string', 'max:50'],
            'button2_link' => ['nullable', 'string', 'max:255', 'not_regex:/^\s*javascript:/i'],
            'background_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
