<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TestWebpGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test WebP image generation with Intervention Image';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Intervention Image v3 WebP generation...');

        try {
            // Test creating ImageManager
            $manager = new ImageManager(new Driver());
            $this->info('✓ ImageManager created successfully');

            // Test reading a simple test image (create a basic one)
            $testImage = imagecreatetruecolor(100, 100);
            $color = imagecolorallocate($testImage, 0, 0, 255);
            imagefill($testImage, 0, 0, $color);

            $testPath = storage_path('app/public/test-image.jpg');
            imagejpeg($testImage, $testPath);
            imagedestroy($testImage);

            $this->info('✓ Test image created at: '.$testPath);

            // Test reading and converting to WebP
            $image = $manager->read($testPath);
            $this->info('✓ Image read successfully');

            $webpPath = storage_path('app/public/test-image.webp');
            $image->toWebp(90)->save($webpPath);
            $this->info('✓ WebP image created at: '.$webpPath);

            // Cleanup
            @unlink($testPath);
            @unlink($webpPath);
            $this->info('✓ Test files cleaned up');

            $this->info('');
            $this->info('✅ All tests passed! WebP generation is working correctly.');
            $this->info('You can now upload images through the CMS and they will automatically generate WebP versions.');
        } catch (\Exception $e) {
            $this->error('❌ Test failed: '.$e->getMessage());
            $this->error('File: '.$e->getFile());
            $this->error('Line: '.$e->getLine());
        }
    }
}
