<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'slug', 'title', 'subtitle', 'client_name', 'location', 'category', 'year',
        'engagement_type', 'cover_image', 'excerpt', 'challenge', 'approach', 'outcome',
        'duration', 'team_info', 'live_url', 'live_label', 'app_store_url', 'play_store_url',
        'featured_stat_value', 'featured_stat_label', 'technologies', 'deliverables',
        'meta_title', 'sort_order', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'deliverables' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function stats(): HasMany
    {
        return $this->hasMany(ProjectStat::class)->orderBy('sort_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('sort_order');
    }

    public function screens(): HasMany
    {
        return $this->hasMany(ProjectScreen::class)->orderBy('sort_order');
    }
}
