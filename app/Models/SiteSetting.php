<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['group', 'key', 'value', 'type'];

    public static function get(string $group, string $key, mixed $default = null): mixed
    {
        $setting = static::query()
            ->where('group', $group)
            ->where('key', $key)
            ->first();

        if (! $setting) {
            return $default;
        }

        return match ($setting->type) {
            'json' => json_decode($setting->value, true),
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            default => $setting->value,
        };
    }

    public static function set(string $group, string $key, mixed $value, string $type = 'text'): void
    {
        $stored = is_array($value) ? json_encode($value) : (string) $value;

        static::query()->updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $stored, 'type' => $type]
        );

        Cache::forget('site_settings');
    }

    public static function group(string $group): array
    {
        return static::query()
            ->where('group', $group)
            ->get()
            ->mapWithKeys(function (SiteSetting $setting) {
                $value = match ($setting->type) {
                    'json' => json_decode($setting->value, true),
                    'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                    default => $setting->value,
                };

                return [$setting->key => $value];
            })
            ->all();
    }
}
