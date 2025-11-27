<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'image_webp',
        'link',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value;

        if ($value && Storage::disk('public')->exists($value)) {
            $path = storage_path('app/public/'.$value);
            $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $path);

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($path);
                $image->toWebp(90)->save($webpPath);
                $this->attributes['image_webp'] = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $value);
            } catch (\Exception $e) {
                // If conversion fails, leave image_webp null
            }
        }
    }
}
