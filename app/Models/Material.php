<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Material extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category',
        'level',
        'image',
        'file_attachment',
        'tags',
        'author',
        'views',
        'published_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
            'views' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Material $material) {
            if (empty($material->slug)) {
                $material->slug = Str::slug($material->title);
            }
            if (empty($material->published_at)) {
                $material->published_at = now();
            }
        });

        static::updating(function (Material $material) {
            if ($material->isDirty('title') && empty($material->slug)) {
                $material->slug = Str::slug($material->title);
            }
        });
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
