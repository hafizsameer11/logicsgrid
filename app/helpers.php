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
    /**
     * Make CMS HTML portable across environments.
     * Converts absolute localhost / APP_URL asset links to root-relative paths.
     */
    function fix_malformed_asset_urls(string $html): string
    {
        // Any absolute host pointing at public folders → root-relative (do this first)
        $html = preg_replace(
            '#https?://[^"\'\s>]+/(assets|css|js|storage)/#i',
            '/$1/',
            $html
        ) ?? $html;

        // Legacy bad concatenations like https://x.com/logicsgrid.org/assets/...
        $html = preg_replace(
            '#https?://[^/"\'\s>]+/logicsgrid\.org/(assets|css|js|storage)/#i',
            '/$1/',
            $html
        ) ?? $html;

        // Local/dev absolute site links → root-relative (keeps external https links intact)
        $html = preg_replace('#https?://localhost(?::\d+)?(/[^"\'\s>]*)?#i', '$1', $html) ?? $html;
        $html = preg_replace('#https?://127\.0\.0\.1(?::\d+)?(/[^"\'\s>]*)?#i', '$1', $html) ?? $html;

        // Empty href after stripping host-only URLs (e.g. http://localhost:8000 → "")
        $html = str_replace(['href=""', "href=''", 'src=""', "src=''"], ['href="/"', "href='/'", 'src="/"', "src='/'"], $html);

        return $html;
    }
}

if (! function_exists('normalize_cms_html')) {
    function normalize_cms_html(?string $html): string
    {
        if (! $html) {
            return '';
        }

        return fix_malformed_asset_urls($html);
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
                        fn (array $matches) => $matches[1] === '/' ? '/' : url($matches[1]),
                        $html
                    ) ?? $html
                ) ?? $html;
            }
        }

        return fix_malformed_asset_urls($html);
    }
}
