<?php

namespace App\Models;

use App\Services\ImageWebpOptimizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a setting value by key with an optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("site_setting_{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting?->value ?? $default;
        });
    }

    /**
     * Set (upsert) a setting value by key and clear its cache.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("site_setting_{$key}");
    }

    /**
     * Return all settings as a key→value array.
     */
    public static function all_settings(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Clear all site setting caches.
     */
    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("site_setting_{$key}");
        }
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function ($setting) {
            if ($setting->isDirty('value') && is_string($setting->value) && ! empty($setting->value)) {
                $ext = strtolower(pathinfo($setting->value, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                    $setting->value = ImageWebpOptimizer::convert($setting->value, 82);
                }
            }
        });
    }
}
