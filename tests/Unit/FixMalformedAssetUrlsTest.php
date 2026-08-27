<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FixMalformedAssetUrlsTest extends TestCase
{
    #[Test]
    public function it_rewrites_localhost_asset_urls_to_root_relative(): void
    {
        $html = '<img src="http://localhost:8000/assets/hero.webp" alt="">';

        $this->assertSame(
            '<img src="/assets/hero.webp" alt="">',
            fix_malformed_asset_urls($html)
        );
    }

    #[Test]
    public function it_rewrites_any_host_asset_urls_to_root_relative(): void
    {
        $html = '<img src="https://logicsgrid.org/assets/logo.png">';

        $this->assertSame(
            '<img src="/assets/logo.png">',
            fix_malformed_asset_urls($html)
        );
    }

    #[Test]
    public function it_rewrites_localhost_page_links(): void
    {
        $html = '<a href="http://localhost:8000/about">About</a>';

        $this->assertSame(
            '<a href="/about">About</a>',
            fix_malformed_asset_urls($html)
        );
    }

    #[Test]
    public function it_preserves_external_non_asset_links(): void
    {
        $html = '<a href="https://example.com/page">External</a>';

        $this->assertSame($html, fix_malformed_asset_urls($html));
    }
}
