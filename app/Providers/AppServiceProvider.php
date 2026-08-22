<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->normalizeAppUrl();
    }

    private function normalizeAppUrl(): void
    {
        $url = (string) config('app.url', '');

        if ($url === '') {
            return;
        }

        if (! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
            $url = 'https://'.ltrim($url, '/');
        }

        $url = rtrim($url, '/');

        // Guard against APP_URL=https://logicsgrid.org/logicsgrid.org
        $parsed = parse_url($url);
        if ($parsed && isset($parsed['path']) && $parsed['path'] !== '' && $parsed['path'] !== '/') {
            $host = $parsed['scheme'].'://'.$parsed['host'].(isset($parsed['port']) ? ':'.$parsed['port'] : '');
            $url = $host;
        }

        URL::forceRootUrl($url);

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
