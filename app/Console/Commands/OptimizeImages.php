<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--dry-run : Show what would be optimized without actually doing it}';

    protected $description = 'Optimize all images in storage for better web performance';

    public function handle(): int
    {
        $this->info('🖼️  Scanning images for optimization...');

        $directories = ['sliders', 'news', 'materials', 'agendas'];
        $totalSaved = 0;
        $imagesProcessed = 0;

        foreach ($directories as $dir) {
            $path = storage_path("app/public/{$dir}");

            if (! File::isDirectory($path)) {
                continue;
            }

            $files = File::files($path);

            foreach ($files as $file) {
                if (! $this->isImage($file->getFilename())) {
                    continue;
                }

                $originalSize = $file->getSize();
                $filePath = $file->getPathname();

                $this->line("Processing: {$file->getFilename()}");

                if ($this->option('dry-run')) {
                    $this->warn('  [DRY RUN] Would optimize this image');

                    continue;
                }

                // Optimize based on type
                $saved = $this->optimizeImage($filePath);

                if ($saved > 0) {
                    $totalSaved += $saved;
                    $imagesProcessed++;
                    $this->info('  ✓ Saved: '.number_format($saved / 1024, 2).' KB');
                }
            }
        }

        if ($this->option('dry-run')) {
            $this->warn("\n🔍 DRY RUN complete. No images were modified.");
            $this->info('Run without --dry-run to actually optimize images.');
        } else {
            $this->info("\n✅ Optimization complete!");
            $this->info("Images processed: {$imagesProcessed}");
            $this->info('Total saved: '.number_format($totalSaved / 1024 / 1024, 2).' MB');
        }

        return Command::SUCCESS;
    }

    protected function isImage(string $filename): bool
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return in_array($extension, ['jpg', 'jpeg', 'png', 'webp']);
    }

    protected function optimizeImage(string $path): int
    {
        if (! function_exists('imagecreatefromjpeg')) {
            $this->error('  ✗ GD library not installed');

            return 0;
        }

        $originalSize = filesize($path);
        $info = getimagesize($path);

        if (! $info) {
            return 0;
        }

        [$width, $height, $type] = $info;

        // Skip if already small enough
        if ($originalSize < 100 * 1024) { // 100KB
            $this->line('  ⊘ Already optimized (< 100KB)');

            return 0;
        }

        // Max dimensions
        $maxWidth = 1920;
        $maxHeight = 1080;

        // Calculate new dimensions
        if ($width > $maxWidth || $height > $maxHeight) {
            $ratio = min($maxWidth / $width, $maxHeight / $height);
            $newWidth = (int) ($width * $ratio);
            $newHeight = (int) ($height * $ratio);
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }

        // Create image resource
        $source = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($path),
            IMAGETYPE_PNG => imagecreatefrompng($path),
            IMAGETYPE_WEBP => imagecreatefromwebp($path),
            default => null,
        };

        if (! $source) {
            return 0;
        }

        // Create resized image
        $resized = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG
        if ($type === IMAGETYPE_PNG) {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save optimized image
        $tempPath = $path.'.tmp';
        $quality = 85; // Good balance between quality and size

        $saved = match ($type) {
            IMAGETYPE_JPEG => imagejpeg($resized, $tempPath, $quality),
            IMAGETYPE_PNG => imagepng($resized, $tempPath, 8),
            IMAGETYPE_WEBP => imagewebp($resized, $tempPath, $quality),
            default => false,
        };

        imagedestroy($source);
        imagedestroy($resized);

        if ($saved) {
            $newSize = filesize($tempPath);

            // Only replace if we saved space
            if ($newSize < $originalSize) {
                rename($tempPath, $path);

                return $originalSize - $newSize;
            } else {
                unlink($tempPath);
                $this->line('  ⊘ No size improvement');
            }
        }

        return 0;
    }
}
