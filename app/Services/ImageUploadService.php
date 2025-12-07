<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

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
            'small' => $config['small'] ?? ['width' => 300, 'height' => 200],
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



    protected function processAndSave(UploadedFile $file, string $folder, string $filename, int $width, int $height): void
    {
        \Log::info("🚀 Starting processAndSave", [
            'folder' => $folder,
            'filename' => $filename,
            'width' => $width,
            'height' => $height
        ]);

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
            \Log::info("📁 Folder created", ['folder' => $folder]);
        }

        try {
            $canvas = $this->resizeExact($file, $width, $height, false);
            \Log::info("🖼 Canvas ready for WebP");
        } catch (\Exception $e) {
            \Log::error("❌ resizeAndPadExact failed", ['error' => $e->getMessage()]);
            throw $e;
        }

        try {
            $webp = $canvas->toWebp(90);
            \Log::info("🌐 WebP created");
        } catch (\Exception $e) {
            \Log::error("❌ WebP conversion failed", ['error' => $e->getMessage()]);
            throw $e;
        }

        try {
            Storage::disk('public')->put("$folder/$filename", (string) $webp);
            \Log::info("✅ Successfully saved WebP", [
                'path' => "$folder/$filename"
            ]);
        } catch (\Exception $e) {
            \Log::error("❌ Save failed", ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    public function resizeExact(string $file, int $width, int $height, bool $allowUpscale = false)
    {
        try {
            $image = $this->manager->read($file);

            $origW = $image->width();
            $origH = $image->height();

            // Calculate scale ratio
            $ratio = min($width / $origW, $height / $origH);
            if (!$allowUpscale) {
                $ratio = min($ratio, 1);
            }

            $newW = (int) floor($origW * $ratio);
            $newH = (int) floor($origH * $ratio);

            // Resize actual image
            $resized = $image->resize($newW, $newH);

            return $resized;
        } catch (\Exception $e) {
            Log::error("❌ resizeExact failed", [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function resizeAndPadExact(string $file, int $width, int $height, bool $allowUpscale = false)
    {
        Log::info("🔹 Starting resizeAndPadExact", [
            'target_width' => $width,
            'target_height' => $height,
            'file' => $file,
            'allow_upscale' => $allowUpscale
        ]);

        try {
            $image = $this->manager->read($file);

            $origW = $image->width();
            $origH = $image->height();

            Log::info("📥 Loaded image", [
                'orig_width' => $origW,
                'orig_height' => $origH,
            ]);

            // Calculate scale ratio
            $ratio = min($width / $origW, $height / $origH);
            if (!$allowUpscale) {
                $ratio = min($ratio, 1);
            }

            $newW = (int) floor($origW * $ratio);
            $newH = (int) floor($origH * $ratio);

            Log::info("📐 Calculated resize", [
                'ratio' => $ratio,
                'new_width' => $newW,
                'new_height' => $newH
            ]);

            // Resize actual image
            $resized = $image->resize($newW, $newH);

            Log::info("🔧 Resized image", [
                'resized_w' => $resized->width(),
                'resized_h' => $resized->height(),
            ]);

            // === CREATE PERFECT CANVAS ===
            // Transparent GD canvas (exact width/height)
            $gd = imagecreatetruecolor($width, $height);

            // enable alpha
            imagealphablending($gd, false);
            imagesavealpha($gd, true);

            // Fill with transparent
            $transparent = imagecolorallocatealpha($gd, 0, 0, 0, 127);
            imagefill($gd, 0, 0, $transparent);

            // Convert GD → PNG binary
            ob_start();
            imagepng($gd);
            $pngBlob = ob_get_clean();

            // Now load the PNG blob into Intervention
            $canvas = $this->manager->read($pngBlob);

            Log::info("🟦 Canvas created", [
                'canvas_width' => $canvas->width(),
                'canvas_height' => $canvas->height()
            ]);

            // Final: center place
            $canvas->place($resized, 'center');

            Log::info("📦 Image placed correctly");

            return $canvas;
        } catch (\Exception $e) {
            Log::error("❌ resizeAndPadExact failed", [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
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
