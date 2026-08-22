<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MediaUrlHelperTest extends TestCase
{
    #[Test]
    public function it_returns_null_for_empty_path(): void
    {
        $this->assertNull(media_url(null));
        $this->assertNull(media_url(''));
    }

    #[Test]
    public function it_returns_absolute_urls_unchanged(): void
    {
        $this->assertSame(
            'https://cdn.example.com/image.webp',
            media_url('https://cdn.example.com/image.webp')
        );
    }

    #[Test]
    public function it_resolves_public_assets_paths(): void
    {
        $url = media_url('assets/hero-cinematic-Dn9NhNBB.webp');

        $this->assertStringContainsString('/assets/hero-cinematic-Dn9NhNBB.webp', $url);
    }

    #[Test]
    public function it_resolves_storage_upload_paths(): void
    {
        $url = media_url('projects/test-cover.webp');

        $this->assertStringContainsString('/storage/projects/test-cover.webp', $url);
    }
}
