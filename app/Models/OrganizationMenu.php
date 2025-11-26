<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrganizationMenu extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::creating(function ($menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->title);
            }
        });
    }
}
