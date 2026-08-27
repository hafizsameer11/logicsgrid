<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'title', 'meta_title', 'meta_description', 'body_html', 'is_published',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    protected static function booted(): void
    {
        static::saving(function (Page $page): void {
            if (filled($page->body_html)) {
                $page->body_html = normalize_cms_html($page->body_html);
            }
        });
    }
}
