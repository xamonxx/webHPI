<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
     * Get background image URL with fallback
     */
    public function getBackgroundUrlAttribute(): string
    {
        if (!$this->background_image) {
            return 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80';
        }

        if (filter_var($this->background_image, FILTER_VALIDATE_URL)) {
            return $this->background_image;
        }

        return asset('storage/uploads/' . $this->background_image);
    }
}
