<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Exception;

class ImageUploadService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload and process image (creates multiple sizes)
     */
    public function upload(UploadedFile $file, string $type): array
    {
        $config = config("images.$type");

        if (!$config) {
            throw new Exception("Image type '$type' not found in config/images.php");
        }

        if (!str_starts_with($file->getMimeType(), 'image/')) {
            throw new Exception('Only image files are allowed.');
        }

        $folder = $config['path'];
        $basename = Str::uuid()->toString(); // single name
        $filename = "{$basename}.webp";      // same name for all sizes

        // Define all target sizes
        $sizes = [
            'icon' => $config['icon'] ?? ['width' => 64, 'height' => 64],
            'small' => $config['small'] ?? ['width' => 200, 'height' => 200],
            'medium' => $config['medium'] ?? ['width' => 600, 'height' => 400],
            'large' => $config['large'] ?? ['width' => 1200, 'height' => 800],
            'original' => null, // full-size upload
        ];

        foreach ($sizes as $size => $dimension) {
            if ($size === 'original') {
                $this->saveOriginal($file, "$folder/original", $filename);
            } else {
                $this->processAndSave($file, "$folder/$size", $filename, $dimension['width'], $dimension['height']);
            }
        }

        return [
            'name' => $filename, // only return filename
        ];
    }

    /**
     * Resize and save image
     */
    protected function processAndSave(UploadedFile $file, string $folder, string $filename, int $width, int $height): void
    {
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        // $image = $this->manager->read($file)->cover($width, $height);


        $image = $this->manager->read($file);
        $image->scaleDown($width, $height);

        $webp = $image->toWebp(90);

        Storage::disk('public')->put("$folder/$filename", (string) $webp);
    }

    /**
     * Save original file as WebP (no resize)
     */
    protected function saveOriginal(UploadedFile $file, string $folder, string $filename): void
    {
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $image = $this->manager->read($file);
        $webp = $image->toWebp(90);

        Storage::disk('public')->put("$folder/$filename", (string) $webp);
    }

    /**
     * Delete all versions of an image
     */
    public function delete(array|string|null $filenames, string $type): void
    {
        if (empty($filenames)) {
            return;
        }

        $config = config("images.$type");
        $folder = $config['path'];
        $sizes = ['icon', 'small', 'medium', 'large', 'original'];
        $files = is_array($filenames) ? $filenames : [$filenames];

        foreach ($files as $file) {
            foreach ($sizes as $size) {
                $path = "$folder/$size/$file";
                Storage::disk('public')->delete($path);
            }
        }
    }
}
