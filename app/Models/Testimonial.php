<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'quote', 'author', 'role', 'is_dark', 'sort_order', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_dark' => 'boolean',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
