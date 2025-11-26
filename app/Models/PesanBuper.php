<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanBuper extends Model
{
    /** @use HasFactory<\Database\Factories\PesanBuperFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'author',
        'author_title',
        'author_photo',
        'published_at',
        'is_active',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }
}
