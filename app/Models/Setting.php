<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get setting value by key
     */
    public static function get($key, $default = null)
    {
        $cacheKey = 'setting_' . $key;
        
        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set setting value
     */
    public static function set($key, $value, $type = 'text', $group = 'general', $label = null, $description = null)
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label ?: $key,
                'description' => $description,
            ]
        );

        // Clear cache
        Cache::forget('setting_' . $key);
        Cache::forget('settings_' . $group);

        return $setting;
    }

    /**
     * Get settings by group
     */
    public static function getByGroup($group)
    {
        $cacheKey = 'settings_' . $group;
        
        return Cache::remember($cacheKey, 3600, function () use ($group) {
            return self::where('group', $group)
                ->orderBy('sort_order')
                ->orderBy('label')
                ->get()
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        $settings = self::all();
        foreach ($settings as $setting) {
            Cache::forget('setting_' . $setting->key);
        }
        
        $groups = self::distinct('group')->pluck('group');
        foreach ($groups as $group) {
            Cache::forget('settings_' . $group);
        }
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget('setting_' . $setting->key);
            Cache::forget('settings_' . $setting->group);
        });

        static::deleted(function ($setting) {
            Cache::forget('setting_' . $setting->key);
            Cache::forget('settings_' . $setting->group);
        });
    }

    /**
     * Scope for ordered settings
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('label');
    }

    /**
     * Scope for group
     */
    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
