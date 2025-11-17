<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'company',
        'message',
        'image',
        'status',
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    /**
     * Automatically append URL fields for image-related columns.
     */
    protected $appends = ['image_url', 'banner_url', 'seo_image_url'];

    /**
     * Define which attributes represent images.
     */
    protected static $imageFields = ['image', 'banner', 'seo_image'];

    /**
     * Common image URL generator.
     */
    protected function generateImageUrl(?string $filename): ?string
    {
        return !empty($filename) ? image_url('page', $filename, 'large') : null;
    }

    /**
     * Dynamically create accessors for *_url attributes.
     */
    public function __get($key)
    {
        // If accessing one of our *_url attributes dynamically
        if (Str::endsWith($key, '_url')) {
            $baseField = Str::beforeLast($key, '_url');
            if (in_array($baseField, self::$imageFields)) {
                return $this->generateImageUrl($this->{$baseField});
            }
        }

        return parent::__get($key);
    }

}
