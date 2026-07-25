<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageWebpOptimizer
{
    /**
     * Convert an uploaded storage image path to optimized WebP format.
     */
    public static function convert(?string $path, int $quality = 80): ?string
    {
        if (empty($path) || Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if (! in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
            return $path;
        }

        $disk = Storage::disk('public');
        if (! $disk->exists($path)) {
            return $path;
        }

        $fullPath = $disk->path($path);
        $newRelPath = static::convertFile($fullPath, $quality);

        if ($newRelPath && $newRelPath !== $fullPath) {
            $dir = pathinfo($path, PATHINFO_DIRNAME);
            $filename = pathinfo($path, PATHINFO_FILENAME);
            $webpRelPath = ($dir !== '.' && $dir !== '' ? $dir.'/' : '').$filename.'.webp';

            return $webpRelPath;
        }

        return $path;
    }

    /**
     * Convert an absolute file system image to WebP and delete the original JPG/PNG.
     *
     * @return string|null Returns the absolute WebP path if successful, or null on failure.
     */
    public static function convertFile(string $absolutePath, int $quality = 80): ?string
    {
        if (! file_exists($absolutePath) || ! is_readable($absolutePath)) {
            return null;
        }

        $ext = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));
        if (! in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
            return null;
        }

        $webpPath = substr_replace($absolutePath, 'webp', strrpos($absolutePath, $ext), strlen($ext));
        if ($webpPath === $absolutePath) {
            return $absolutePath;
        }

        $img = match ($ext) {
            'png' => @imagecreatefrompng($absolutePath),
            'jpg', 'jpeg' => @imagecreatefromjpeg($absolutePath),
            default => false,
        };

        if ($img === false) {
            return null;
        }

        if ($ext === 'png') {
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
        }

        $success = @imagewebp($img, $webpPath, $quality);
        @imagedestroy($img);

        if ($success && file_exists($webpPath) && filesize($webpPath) > 0) {
            if ($webpPath !== $absolutePath && file_exists($absolutePath)) {
                @unlink($absolutePath);
            }

            return $webpPath;
        }

        return null;
    }
}
