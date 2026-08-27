<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Service;
use Illuminate\Console\Command;

class NormalizeCmsUrlsCommand extends Command
{
    protected $signature = 'cms:normalize-urls';

    protected $description = 'Rewrite localhost/absolute asset URLs in CMS HTML to portable root-relative paths';

    public function handle(): int
    {
        $updated = 0;

        foreach (Page::query()->get() as $page) {
            $original = $page->body_html ?? '';
            $fixed = normalize_cms_html($original);
            if ($fixed !== $original) {
                $page->body_html = $fixed;
                $page->saveQuietly();
                $updated++;
                $this->line("Fixed page: {$page->slug}");
            }
        }

        foreach (Service::query()->get() as $service) {
            $original = $service->body_html ?? '';
            $fixed = normalize_cms_html($original);
            if ($fixed !== $original) {
                $service->body_html = $fixed;
                $service->saveQuietly();
                $updated++;
                $this->line("Fixed service: {$service->slug}");
            }
        }

        $this->info("Normalized {$updated} CMS records.");

        return self::SUCCESS;
    }
}
