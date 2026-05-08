<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title',
        'title_highlight',
        'subtitle',
        'background_image',
        'button1_text',
        'button1_link',
        'button2_text',
        'button2_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Only active hero sections
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Get local background image URL.
     */
    public function getBackgroundUrlAttribute(): ?string
    {
        if (! $this->background_image) {
            return null;
        }

        if (filter_var($this->background_image, FILTER_VALIDATE_URL)) {
            return null;
        }

        if (str_contains($this->background_image, '/')) {
            return asset($this->background_image);
        }

        return asset('storage/uploads/'.$this->background_image);
    }
}
