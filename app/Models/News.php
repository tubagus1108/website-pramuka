<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'image_webp',
        'category',
        'tags',
        'author',
        'published_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
            if (empty($news->published_at)) {
                $news->published_at = now();
            }
        });

        static::updating(function (News $news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
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
