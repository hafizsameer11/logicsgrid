<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'role_badge', 'title', 'bio', 'photo', 'location', 'initials',
        'skills', 'section', 'sort_order', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }
}
