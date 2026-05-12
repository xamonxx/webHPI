<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_active === true;
    }

    public function rules(): array
    {
        return [
            'stat_number' => ['required', 'string', 'max:20'],
            'stat_suffix' => ['nullable', 'string', 'max:10'],
            'stat_label' => ['required', 'string', 'max:100'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
