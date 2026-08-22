<?php

namespace Tests\Feature\Cms;

use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

class DynamicContentAdjustabilityTest extends CmsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
    }

    #[Test]
    public function homepage_reflects_updated_hero_title(): void
    {
        SiteSetting::updateOrCreate(
            ['group' => 'hero', 'key' => 'title_line1'],
            ['value' => 'AUTOMATION TEST TITLE', 'type' => 'text']
        );

        $this->get('/')
            ->assertOk()
            ->assertSee('AUTOMATION TEST TITLE', false);
    }

    #[Test]
    public function homepage_reflects_updated_service_title(): void
    {
        $service = Service::where('slug', 'software-development')->firstOrFail();
        $service->update(['title' => 'Automation Test Service Title']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Automation Test Service Title', false);
    }

    #[Test]
    public function homepage_reflects_updated_testimonial(): void
    {
        $testimonial = Testimonial::where('is_featured', true)->firstOrFail();
        $testimonial->update(['quote' => 'Automation testimonial quote unique string XYZ123']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Automation testimonial quote unique string XYZ123', false);
    }

    #[Test]
    public function homepage_reflects_updated_team_member(): void
    {
        $member = TeamMember::where('section', 'home')->firstOrFail();
        $member->update(['name' => 'Automation Team Name ABC']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Automation Team Name ABC', false);
    }

    #[Test]
    public function about_page_reflects_updated_body_html(): void
    {
        $page = Page::where('slug', 'about')->firstOrFail();
        $page->update(['body_html' => '<div>AUTOMATION ABOUT PAGE MARKER 98765</div>']);

        $this->get('/about')
            ->assertOk()
            ->assertSee('AUTOMATION ABOUT PAGE MARKER 98765', false);
    }

    #[Test]
    public function service_page_reflects_updated_body_html(): void
    {
        $service = Service::where('slug', 'ai-solutions')->firstOrFail();
        $service->update(['body_html' => '<div>AUTOMATION AI PAGE MARKER 54321</div>']);

        $this->get('/ai-solutions')
            ->assertOk()
            ->assertSee('AUTOMATION AI PAGE MARKER 54321', false);
    }

    #[Test]
    public function project_page_reflects_updated_title_and_challenge(): void
    {
        $project = Project::where('slug', 'kokolet-luxury')->firstOrFail();
        $project->update([
            'title' => 'Automation Project Title QWE',
            'challenge' => 'Automation challenge text RTY',
        ]);

        $this->get('/portfolio/kokolet-luxury')
            ->assertOk()
            ->assertSee('Automation Project Title QWE', false)
            ->assertSee('Automation challenge text RTY', false);
    }

    #[Test]
    public function unpublished_project_returns_not_found(): void
    {
        Project::where('slug', 'billspro-fintech')->update(['is_published' => false]);

        $this->get('/portfolio/billspro-fintech')->assertNotFound();
    }

    #[Test]
    public function unpublished_page_falls_back_or_not_found(): void
    {
        Page::where('slug', 'privacy')->update([
            'is_published' => false,
            'body_html' => '<div>UNPUBLISHED_DB_ONLY_MARKER_XYZ</div>',
        ]);

        $response = $this->get('/privacy');

        $this->assertFalse(
            str_contains($response->getContent(), 'UNPUBLISHED_DB_ONLY_MARKER_XYZ'),
            'Unpublished DB page HTML should not be rendered when fallback exists'
        );
    }
}
