<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize';
    protected $description = 'Optimize and resize images';

    public function handle()
    {
        $manager = new ImageManager(new Driver());

        // Resize logo
        $logoPath = public_path('img/Logo-Pramuka.jpeg');
        if (file_exists($logoPath)) {
            $image = $manager->read($logoPath);
            $image->scale(width: 300); // Resize to max 300px width
            $image->save(public_path('img/Logo-Pramuka-small.jpeg'), quality: 85);
            $this->info('Logo resized successfully');
        }

        return 0;
    }
}
