<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug', 'number', 'category_label', 'title', 'description', 'image',
        'tags', 'body_html', 'sort_order', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Service $service): void {
            if (filled($service->body_html)) {
                $service->body_html = normalize_cms_html($service->body_html);
            }
        });
    }
}
