<?php

use Illuminate\Support\Facades\Blade;

if (! function_exists('media_url')) {
    function media_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }
}

if (! function_exists('render_cms_html')) {
    function render_cms_html(?string $html): string
    {
        if (! $html) {
            return '';
        }

        if (! str_contains($html, '{{') && ! str_contains($html, '@')) {
            return $html;
        }

        try {
            return Blade::render($html);
        } catch (\Throwable) {
            return preg_replace_callback(
                "/\{\{\s*asset\(\s*['\"]([^'\"]+)['\"]\s*\)\s*\}\}/",
                fn (array $matches) => asset($matches[1]),
                preg_replace_callback(
                    "/\{\{\s*url\(\s*['\"]([^'\"]+)['\"]\s*\)\s*\}\}/",
                    fn (array $matches) => url($matches[1]),
                    $html
                ) ?? $html
            ) ?? $html;
        }
    }
}
