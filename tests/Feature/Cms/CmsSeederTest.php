<?php

namespace Tests\Feature\Cms;

use App\Models\Industry;
use App\Models\JobListing;
use App\Models\MarqueeItem;
use App\Models\Page;
use App\Models\ProblemCard;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\ProjectScreen;
use App\Models\ProjectStat;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WhyReason;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

class CmsSeederTest extends CmsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
    }

    #[Test]
    public function it_seeds_admin_user(): void
    {
        $this->assertDatabaseHas('users', [
            'email' => 'admin@logicsgrid.com',
            'name' => 'LogicsGrid Admin',
        ]);
    }

    #[Test]
    public function it_seeds_all_cms_tables_with_expected_minimums(): void
    {
        $this->assertGreaterThanOrEqual(50, SiteSetting::count());
        $this->assertGreaterThanOrEqual(6, Stat::count());
        $this->assertGreaterThanOrEqual(6, MarqueeItem::count());
        $this->assertGreaterThanOrEqual(4, ProblemCard::count());
        $this->assertSame(5, Service::count());
        $this->assertGreaterThanOrEqual(6, WhyReason::count());
        $this->assertGreaterThanOrEqual(6, ProcessStep::count());
        $this->assertGreaterThanOrEqual(10, Industry::count());
        $this->assertGreaterThanOrEqual(3, Testimonial::count());
        $this->assertGreaterThanOrEqual(15, TeamMember::count());
        $this->assertGreaterThanOrEqual(4, SocialLink::count());
        $this->assertGreaterThanOrEqual(3, JobListing::count());
        $this->assertGreaterThanOrEqual(9, Page::count());
        $this->assertSame(15, Project::count());
    }

    #[Test]
    public function it_seeds_kokolet_luxury_project_with_nested_content(): void
    {
        $project = Project::where('slug', 'kokolet-luxury')->first();

        $this->assertNotNull($project);
        $this->assertNotEmpty($project->cover_image);
        $this->assertNotEmpty($project->challenge);
        $this->assertNotEmpty($project->approach);
        $this->assertNotEmpty($project->outcome);
        $this->assertGreaterThanOrEqual(3, ProjectStat::where('project_id', $project->id)->count());
        $this->assertGreaterThanOrEqual(6, ProjectFeature::where('project_id', $project->id)->count());
        $this->assertGreaterThanOrEqual(9, ProjectScreen::where('project_id', $project->id)->count());
    }

    #[Test]
    public function it_seeds_services_with_body_html_and_images(): void
    {
        Service::all()->each(function (Service $service) {
            $this->assertNotEmpty($service->slug);
            $this->assertNotEmpty($service->title);
            $this->assertNotEmpty($service->body_html);
            $this->assertNotEmpty($service->image);
        });
    }

    #[Test]
    public function it_seeds_pages_with_body_html(): void
    {
        Page::all()->each(function (Page $page) {
            $this->assertNotEmpty($page->slug);
            $this->assertNotEmpty($page->title);
            $this->assertNotEmpty($page->body_html);
        });
    }

    #[Test]
    public function seeded_image_paths_point_to_existing_public_assets(): void
    {
        $paths = collect([
            SiteSetting::where('key', 'hero_image')->value('value'),
            Service::pluck('image'),
            Project::pluck('cover_image'),
            TeamMember::whereNotNull('photo')->pluck('photo'),
            ProjectScreen::pluck('image'),
        ])->flatten()->filter(fn ($p) => is_string($p) && str_starts_with($p, 'assets/'));

        $this->assertNotEmpty($paths);

        foreach ($paths as $path) {
            $this->assertFileExists(
                public_path($path),
                "Missing public asset: {$path}"
            );
        }
    }
}
