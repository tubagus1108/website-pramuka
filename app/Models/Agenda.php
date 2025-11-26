<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
