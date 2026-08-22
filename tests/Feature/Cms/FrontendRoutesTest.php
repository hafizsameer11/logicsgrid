<?php

namespace Tests\Feature\Cms;

use App\Models\Project;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

class FrontendRoutesTest extends CmsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
    }

    #[Test]
    public function homepage_returns_success(): void
    {
        $this->get('/')->assertOk();
    }

    #[Test]
    #[DataProvider('pageRoutesProvider')]
    public function static_pages_return_success(string $path): void
    {
        $this->get($path)->assertOk();
    }

    #[Test]
    #[DataProvider('serviceRoutesProvider')]
    public function service_pages_return_success(string $path): void
    {
        $this->get($path)->assertOk();
    }

    #[Test]
    public function all_portfolio_projects_return_success(): void
    {
        Project::pluck('slug')->each(function (string $slug) {
            $this->get("/portfolio/{$slug}")->assertOk();
        });
    }

    #[Test]
    public function health_check_returns_success(): void
    {
        $this->get('/up')->assertOk();
    }

    public static function pageRoutesProvider(): array
    {
        return [
            'about' => ['/about'],
            'team' => ['/team'],
            'contact' => ['/contact'],
            'portfolio index' => ['/portfolio'],
            'why logicsgrid' => ['/why-logicsgrid'],
            'strategy session' => ['/strategy-session'],
            'industries' => ['/industries'],
            'privacy' => ['/privacy'],
            'terms' => ['/terms'],
        ];
    }

    public static function serviceRoutesProvider(): array
    {
        return [
            'software development' => ['/software-development'],
            'startup growth' => ['/startup-growth'],
            'ai solutions' => ['/ai-solutions'],
            'venture building' => ['/venture-building'],
            'business digitization' => ['/business-digitization'],
        ];
    }
}
