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

        if (str_starts_with($path, 'assets/') || str_starts_with($path, 'css/') || str_starts_with($path, 'js/')) {
            return public_asset($path);
        }

        return public_asset('storage/'.$path);
    }
}

if (! function_exists('public_asset')) {
    function public_asset(string $path): string
    {
        return '/'.ltrim($path, '/');
    }
}

if (! function_exists('fix_malformed_asset_urls')) {
    function fix_malformed_asset_urls(string $html): string
    {
        $html = preg_replace('#https?://[^"\'\s>]+\.[^/"\'\s>]+/logicsgrid\.org/(assets|css|js)/#', '/$1/', $html) ?? $html;

        return preg_replace('#/logicsgrid\.org/(assets|css|js)/#', '/$1/', $html) ?? $html;
    }
}

if (! function_exists('render_cms_html')) {
    function render_cms_html(?string $html): string
    {
        if (! $html) {
            return '';
        }

        if (str_contains($html, '{{') || str_contains($html, '@')) {
            try {
                $html = Blade::render($html);
            } catch (\Throwable) {
                $html = preg_replace_callback(
                    "/\{\{\s*asset\(\s*['\"]([^'\"]+)['\"]\s*\)\s*\}\}/",
                    fn (array $matches) => public_asset($matches[1]),
                    preg_replace_callback(
                        "/\{\{\s*url\(\s*['\"]([^'\"]+)['\"]\s*\)\s*\}\}/",
                        fn (array $matches) => url($matches[1]),
                        $html
                    ) ?? $html
                ) ?? $html;
            }
        }

        return fix_malformed_asset_urls($html);
    }
}
