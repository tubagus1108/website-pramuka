<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ConvertToWebP extends Command
{
    protected $signature = 'images:webp';
    protected $description = 'Convert images to WebP format';

    public function handle()
    {
        $manager = new ImageManager(new Driver());

        // Convert logo
        $logoPath = public_path('img/Logo-Pramuka.jpeg');
        if (file_exists($logoPath)) {
            $image = $manager->read($logoPath);
            $image->scale(width: 300);
            $image->toWebp(85)->save(public_path('img/Logo-Pramuka.webp'));
            $this->info('Logo converted to WebP');
        }

        // Convert news images
        $newsDir = storage_path('app/public/news');
        if (is_dir($newsDir)) {
            $files = glob($newsDir . '/*.{jpg,jpeg,png}', GLOB_BRACE);

            foreach ($files as $file) {
                $image = $manager->read($file);
                $webpPath = pathinfo($file, PATHINFO_DIRNAME) . '/' .
                           pathinfo($file, PATHINFO_FILENAME) . '.webp';
                $image->toWebp(85)->save($webpPath);
                $this->info('Converted: ' . basename($file));
            }
        }

        return 0;
    }
}
