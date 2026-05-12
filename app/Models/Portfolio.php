<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'image',
        'slider_images',
        'display_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
        'slider_images' => 'array',
    ];

    /**
     * Scope: Only active portfolios
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Only featured portfolios
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Order by display_order then created_at desc
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderByDesc('created_at');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PortfolioPhoto::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * Resolve a stored image path into a public URL.
     */
    public function resolveImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        $normalized = ltrim(str_replace('\\', '/', $path), '/');

        if (str_starts_with($normalized, 'assets/')) {
            return asset($normalized);
        }

        if (str_starts_with($normalized, 'storage/')) {
            return asset($normalized);
        }

        return asset('storage/'.$normalized);
    }

    protected function photoPaths(): array
    {
        if ($this->relationLoaded('photos') && $this->photos->isNotEmpty()) {
            return $this->photos
                ->pluck('path')
                ->filter()
                ->unique()
                ->values()
                ->toArray();
        }

        $relationPaths = $this->photos()
            ->pluck('path')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        if (! empty($relationPaths)) {
            return $relationPaths;
        }

        return collect(array_merge(
            $this->image ? [$this->image] : [],
            $this->slider_images ?: []
        ))->filter()->unique()->values()->toArray();
    }

    /**
     * Get local image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveImageUrl(collect($this->photoPaths())->first());
    }

    /**
     * Get slider image URLs
     */
    public function getSliderUrlsAttribute(): array
    {
        return collect($this->photoPaths())
            ->map(fn ($path) => $this->resolveImageUrl($path))
            ->filter()
            ->values()
            ->toArray();
    }

    /**
     * Get all gallery images (main + sliders) as URLs
     */
    public function getAllImagesAttribute(): array
    {
        return collect($this->slider_urls)->unique()->values()->toArray();
    }

    /**
     * Get category or default
     */
    public function getCategoryDisplayAttribute(): string
    {
        return $this->category ?? 'Interior';
    }
}
