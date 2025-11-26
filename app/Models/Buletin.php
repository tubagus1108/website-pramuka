<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Buletin extends Model
{
    /** @use HasFactory<\Database\Factories\BuletinFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_image',
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
}
