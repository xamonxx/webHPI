<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'setting_group',
    ];

    /**
     * Get setting value by key with caching
     */
    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('setting_key', $key)->first();

            return $setting ? $setting->setting_value : $default;
        });
    }

    /**
     * Set setting value (create or update)
     */
    public static function set(string $key, $value, string $type = 'text', string $group = 'general'): void
    {
        static::updateOrCreate(
            ['setting_key' => $key],
            [
                'setting_value' => $value,
                'setting_type' => $type,
                'setting_group' => $group,
            ]
        );

        Cache::forget("setting.{$key}");
        Cache::forget('settings.all');
    }

    /**
     * Set multiple setting rows with one database upsert.
     *
     * @param  array<int, array{key:string,value:mixed,type?:string,group?:string}>  $settings
     */
    public static function setMany(array $settings): void
    {
        if (empty($settings)) {
            return;
        }

        $now = now();
        $rows = collect($settings)
            ->map(fn (array $setting) => [
                'setting_key' => $setting['key'],
                'setting_value' => $setting['value'],
                'setting_type' => $setting['type'] ?? 'text',
                'setting_group' => $setting['group'] ?? 'general',
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->values()
            ->all();

        static::upsert(
            $rows,
            ['setting_key'],
            ['setting_value', 'setting_type', 'setting_group', 'updated_at']
        );

        Cache::forget('settings.all');

        foreach ($settings as $setting) {
            Cache::forget("setting.{$setting['key']}");
        }
    }

    /**
     * Get all settings as key-value array
     */
    public static function getAllAsArray(): array
    {
        return Cache::remember('settings.all', 3600, function () {
            return static::pluck('setting_value', 'setting_key')->toArray();
        });
    }

    /**
     * Get settings by group
     */
    public static function getByGroup(string $group): array
    {
        return static::where('setting_group', $group)
            ->pluck('setting_value', 'setting_key')
            ->toArray();
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        Cache::forget('settings.all');

        $settings = static::all();
        foreach ($settings as $setting) {
            Cache::forget("setting.{$setting->setting_key}");
        }
    }
}
