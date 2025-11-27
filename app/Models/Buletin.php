<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Buletin extends Model
{
    /** @use HasFactory<\Database\Factories\BuletinFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
        'cover_image_webp',
        'file_pdf',
        'edition',
        'month',
        'year',
        'views',
        'published_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_active' => 'boolean',
            'views' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($buletin) {
            if (empty($buletin->slug)) {
                $buletin->slug = Str::slug($buletin->title);
            }
        });

        static::updating(function ($buletin) {
            if ($buletin->isDirty('title')) {
                $buletin->slug = Str::slug($buletin->title);
            }
        });
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function setCoverImageAttribute($value)
    {
        $this->attributes['cover_image'] = $value;

        if ($value && Storage::disk('public')->exists($value)) {
            $path = storage_path('app/public/'.$value);
            $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $path);

            try {
                $image = Image::make($path);
                $image->encode('webp', 90)->save($webpPath);
                $this->attributes['cover_image_webp'] = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $value);
            } catch (\Exception $e) {
                // If conversion fails, leave cover_image_webp null
            }
        }
    }
}
