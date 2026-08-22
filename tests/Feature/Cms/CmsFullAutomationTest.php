<?php

namespace Tests\Feature\Cms;

use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

/**
 * End-to-end automation: simulates admin edits and verifies live site output.
 */
class CmsFullAutomationTest extends CmsTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
    }

    #[Test]
    public function complete_cms_edit_cycle_updates_entire_site(): void
    {
        $admin = User::where('email', 'admin@logicsgrid.com')->firstOrFail();
        $this->assertTrue($admin->canAccessPanel(filament()->getCurrentOrDefaultPanel()));

        // 1. Site settings — hero copy
        SiteSetting::updateOrCreate(
            ['group' => 'hero', 'key' => 'title_line1'],
            ['value' => 'E2E Full Cycle Title', 'type' => 'text']
        );
        SiteSetting::updateOrCreate(
            ['group' => 'hero', 'key' => 'hero_image'],
            ['value' => 'assets/hero-cinematic-Dn9NhNBB.webp', 'type' => 'text']
        );

        // 2. Service edit
        Service::where('slug', 'software-development')->update([
            'title' => 'E2E Software Service',
            'image' => 'assets/pillar-software-Cc1akc0k.webp',
        ]);

        // 3. Project edit with nested content
        $project = Project::where('slug', 'kokolet-luxury')->firstOrFail();
        $project->update([
            'title' => 'E2E Kokolet Project',
            'cover_image' => 'assets/cover-DLmc0UiI.webp',
            'challenge' => 'E2E challenge paragraph',
        ]);
        ProjectFeature::where('project_id', $project->id)->first()?->update([
            'title' => 'E2E Feature Title',
        ]);

        // 4. Team photo
        TeamMember::where('section', 'home')->first()?->update([
            'photo' => 'assets/peter-B8Rx5Lk1.webp',
            'name' => 'E2E Peter',
        ]);

        // Verify homepage aggregates all changes
        $home = $this->get('/');
        $home->assertOk()
            ->assertSee('E2E Full Cycle Title', false)
            ->assertSee('E2E Software Service', false)
            ->assertSee('E2E Peter', false)
            ->assertSee(media_url('assets/hero-cinematic-Dn9NhNBB.webp'), false)
            ->assertSee(media_url('assets/pillar-software-Cc1akc0k.webp'), false)
            ->assertSee(media_url('assets/cover-DLmc0UiI.webp'), false)
            ->assertSee(media_url('assets/peter-B8Rx5Lk1.webp'), false);

        // Verify project page
        $this->get('/portfolio/kokolet-luxury')
            ->assertOk()
            ->assertSee('E2E Kokolet Project', false)
            ->assertSee('E2E challenge paragraph', false)
            ->assertSee('E2E Feature Title', false)
            ->assertSee(media_url('assets/cover-DLmc0UiI.webp'), false);

        // Verify admin can reach all resources after edits
        $this->actingAs($admin)->get('/admin/projects')->assertOk();
        $this->actingAs($admin)->get('/admin/services')->assertOk();
        $this->actingAs($admin)->get('/admin/site-settings')->assertOk();
        $this->actingAs($admin)->get('/admin/team-members')->assertOk();
    }
}
