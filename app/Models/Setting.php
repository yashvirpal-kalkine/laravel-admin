<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Keys that represent image paths.
     */
    protected static $imageKeys = [
        'banner',
        'image',
        'seo_image',
        'header_logo',
        'footer_logo',
        'favicon',
    ];

    /**
     * Get all settings as key => value array,
     * and add *_url for image-based keys.
     */
    public static function allWithUrls()
    {
        $items = parent::all();
        $settings = $items->pluck('value', 'key')->toArray();

        foreach (self::$imageKeys as $key) {
            if (!empty($settings[$key])) {
                $settings["{$key}_url"] = image_url('setting', $settings[$key], 'small');
            }
        }

        return $settings;
    }

    /**
     * Get setting by key (simple return value).
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->value('value');
        return $setting ?? $default;
    }

    /**
     * Set or update a setting
     */
    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
