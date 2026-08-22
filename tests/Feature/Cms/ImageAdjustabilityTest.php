<?php

namespace Tests\Feature\Cms;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\ProjectScreen;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

class ImageAdjustabilityTest extends CmsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
        Storage::fake('public');
    }

    #[Test]
    public function homepage_reflects_updated_hero_image_from_assets(): void
    {
        SiteSetting::updateOrCreate(
            ['group' => 'hero', 'key' => 'hero_image'],
            ['value' => 'assets/pillar-software-Cc1akc0k.webp', 'type' => 'text']
        );

        $expected = media_url('assets/pillar-software-Cc1akc0k.webp');

        $this->get('/')
            ->assertOk()
            ->assertSee($expected, false);
    }

    #[Test]
    public function homepage_reflects_uploaded_hero_image_from_storage(): void
    {
        $path = 'hero/automation-hero.webp';
        Storage::disk('public')->put($path, 'fake-image-content');

        SiteSetting::updateOrCreate(
            ['group' => 'hero', 'key' => 'hero_image'],
            ['value' => $path, 'type' => 'text']
        );

        $this->get('/')
            ->assertOk()
            ->assertSee(media_url($path), false);
    }

    #[Test]
    public function service_page_reflects_updated_service_image(): void
    {
        $service = Service::where('slug', 'venture-building')->firstOrFail();
        $service->update(['image' => 'assets/vb-hero-BKxo5rR_.webp']);

        $this->get('/')
            ->assertOk()
            ->assertSee(media_url('assets/vb-hero-BKxo5rR_.webp'), false);
    }

    #[Test]
    public function project_page_reflects_updated_cover_image(): void
    {
        $project = Project::where('slug', 'colala-mall')->firstOrFail();
        $project->update(['cover_image' => 'assets/cover-BW6TswZN.webp']);

        $this->get('/portfolio/colala-mall')
            ->assertOk()
            ->assertSee(media_url('assets/cover-BW6TswZN.webp'), false);
    }

    #[Test]
    public function project_page_reflects_updated_screen_images(): void
    {
        $project = Project::where('slug', 'kokolet-luxury')->firstOrFail();
        $screen = $project->screens()->firstOrFail();
        $screen->update(['image' => 'assets/shop-DtlQsaG3.webp']);

        $this->get('/portfolio/kokolet-luxury')
            ->assertOk()
            ->assertSee(media_url('assets/shop-DtlQsaG3.webp'), false);
    }

    #[Test]
    public function team_section_reflects_updated_member_photo(): void
    {
        $member = TeamMember::where('section', 'home')->firstOrFail();
        $member->update(['photo' => 'assets/juliana-D96bP1Zi.webp']);

        $this->get('/')
            ->assertOk()
            ->assertSee(media_url('assets/juliana-D96bP1Zi.webp'), false);
    }

    #[Test]
    public function featured_projects_reflect_updated_cover_on_homepage(): void
    {
        $project = Project::where('slug', 'kokolet-luxury')->firstOrFail();
        $project->update([
            'is_featured' => true,
            'cover_image' => 'assets/cover-DLmc0UiI.webp',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee(media_url('assets/cover-DLmc0UiI.webp'), false);
    }

    #[Test]
    public function media_url_helper_works_for_simulated_admin_upload(): void
    {
        $file = UploadedFile::fake()->image('team-photo.jpg');
        $stored = $file->store('team-members', 'public');

        $member = TeamMember::where('section', 'home')->firstOrFail();
        $member->update(['photo' => $stored]);

        $this->get('/')
            ->assertOk()
            ->assertSee(media_url($stored), false);

        Storage::disk('public')->assertExists($stored);
    }
}
