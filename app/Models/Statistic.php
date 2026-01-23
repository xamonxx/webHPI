<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Statistic extends Model
{
    protected $fillable = [
        'stat_number',
        'stat_suffix',
        'stat_label',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Scope: Only active statistics
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
     * Check if suffix is "th" for special styling
     */
    public function getIsThSuffixAttribute(): bool
    {
        return strtolower($this->stat_suffix ?? '') === 'th';
    }
}
