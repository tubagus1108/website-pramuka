<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImagesCommand extends Command
{
    protected $signature = 'images:optimize {--path=storage/app/public}';
    protected $description = 'Check and report on images that need optimization';

    public function handle(): int
    {
        $path = storage_path('app/public');
        
        if (!File::exists($path)) {
            $this->error("Path does not exist: {$path}");
            return self::FAILURE;
        }

        $this->info('🖼️  Analyzing images...');
        $this->newLine();

        $images = File::allFiles($path);
        $needOptimization = [];
        $totalSize = 0;

        foreach ($images as $image) {
            if (!in_array($image->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                continue;
            }

            $size = $image->getSize();
            $totalSize += $size;

            // Flag images larger than 500KB for optimization
            if ($size > 500000) {
                $needOptimization[] = [
                    'name' => $image->getFilename(),
                    'path' => $image->getRelativePathname(),
                    'size' => $size,
                ];
            }
        }

        $this->info("📊 Image Analysis Report:");
        $this->info("Total images: " . count($images));
        $this->info("Total size: " . $this->formatBytes($totalSize));
        $this->info("Need optimization: " . count($needOptimization));

        if (count($needOptimization) > 0) {
            $this->newLine();
            $this->warn("⚠️  Large images found (>500KB):");
            foreach ($needOptimization as $img) {
                $this->line("  • {$img['name']} - {$this->formatBytes($img['size'])}");
            }
            $this->newLine();
            $this->info("💡 Recommendation: Compress these images before uploading");
            $this->info("   Use tools like: TinyPNG, Squoosh, or ImageOptim");
        } else {
            $this->info("✅ All images are optimized!");
        }

        return self::SUCCESS;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }
}
