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

    public function getImageUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->image);
    }

    public function getBannerUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->banner);
    }

    public function getSeoImageUrlAttribute(): ?string
    {
        return $this->generateImageUrl($this->seo_image);
    }

}
