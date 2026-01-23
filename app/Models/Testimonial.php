<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'client_location',
        'client_image',
        'testimonial_text',
        'rating',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Scope: Only active testimonials
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by display_order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    /**
     * Get client initials for avatar
     */
    public function getInitialsAttribute(): string
    {
        return strtoupper(substr($this->client_name, 0, 1));
    }

    /**
     * Get client image URL with fallback
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->client_image) {
            return null;
        }

        if (filter_var($this->client_image, FILTER_VALIDATE_URL)) {
            return $this->client_image;
        }

        return asset('storage/uploads/' . $this->client_image);
    }

    /**
     * Get stars array for rating display
     */
    public function getStarsAttribute(): array
    {
        return array_fill(0, $this->rating, true);
    }
}
