<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Services\ImageWebpOptimizer;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

#[Signature('app:optimize-images-to-webp {--quality=80 : WebP compression quality between 0 and 100}')]
#[Description('Scan public storage images, convert JPG/PNG to compressed WebP, delete old files, and update database paths')]
class OptimizeImagesToWebp extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $quality = (int) $this->option('quality');
        $directory = storage_path('app/public');

        if (! File::exists($directory)) {
            $this->error('Storage directory not found: '.$directory);

            return Command::FAILURE;
        }

        $this->info("Scanning directory [{$directory}] for JPG/PNG files...");

        $files = File::allFiles($directory);
        $convertedCount = 0;
        $totalSavedBytes = 0;

        foreach ($files as $file) {
            $ext = strtolower($file->getExtension());
            if (in_array($ext, ['jpg', 'jpeg', 'png'], true)) {
                $oldSize = $file->getSize();
                $oldPath = $file->getRealPath();

                $newPath = ImageWebpOptimizer::convertFile($oldPath, $quality);
                if ($newPath && file_exists($newPath)) {
                    $newSize = filesize($newPath);
                    $saved = max(0, $oldSize - $newSize);
                    $totalSavedBytes += $saved;
                    $convertedCount++;
                    $this->line('Converted: '.basename($oldPath).' -> '.basename($newPath).' (-'.round($saved / 1024, 1).' KiB)');
                }
            }
        }

        // Update database records to reflect new .webp extensions
        $this->info('Updating database file path references...');

        // Products
        $products = Product::where('image_path', 'LIKE', '%.jpg')
            ->orWhere('image_path', 'LIKE', '%.jpeg')
            ->orWhere('image_path', 'LIKE', '%.png')
            ->get();
        foreach ($products as $product) {
            $product->image_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $product->image_path);
            $product->saveQuietly();
        }
        $this->line('Updated products count: '.$products->count());

        // Blogs
        $blogs = Blog::where('image_path', 'LIKE', '%.jpg')
            ->orWhere('image_path', 'LIKE', '%.jpeg')
            ->orWhere('image_path', 'LIKE', '%.png')
            ->get();
        foreach ($blogs as $blog) {
            $blog->image_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $blog->image_path);
            $blog->saveQuietly();
        }
        $this->line('Updated blogs count: '.$blogs->count());

        // Site Settings
        $settings = SiteSetting::where('value', 'LIKE', '%.jpg')
            ->orWhere('value', 'LIKE', '%.jpeg')
            ->orWhere('value', 'LIKE', '%.png')
            ->get();
        foreach ($settings as $setting) {
            $setting->value = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $setting->value);
            $setting->saveQuietly();
        }
        if ($settings->isNotEmpty()) {
            SiteSetting::clearCache();
        }
        $this->line('Updated site settings count: '.$settings->count());

        $savedMb = round($totalSavedBytes / 1024 / 1024, 2);
        $this->info("Successfully converted {$convertedCount} images to WebP! Total storage saved: {$savedMb} MB.");

        return Command::SUCCESS;
    }
}
