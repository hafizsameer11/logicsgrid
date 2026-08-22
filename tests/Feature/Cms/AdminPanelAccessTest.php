<?php

namespace Tests\Feature\Cms;

use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\CmsTestCase;

class AdminPanelAccessTest extends CmsTestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedCms();
        $this->admin = User::where('email', 'admin@logicsgrid.com')->firstOrFail();
    }

    #[Test]
    public function guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get('/admin')->assertRedirect();
    }

    #[Test]
    public function admin_can_view_login_page(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    #[Test]
    public function admin_can_access_dashboard(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin')
            ->assertOk();
    }

    #[Test]
    #[DataProvider('adminResourceRoutesProvider')]
    public function admin_can_access_all_cms_resource_index_pages(string $path): void
    {
        $this->actingAs($this->admin)
            ->get($path)
            ->assertOk();
    }

    #[Test]
    public function admin_can_access_project_edit_page(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/projects/1/edit')
            ->assertOk();
    }

    public static function adminResourceRoutesProvider(): array
    {
        return [
            'site settings' => ['/admin/site-settings'],
            'stats' => ['/admin/stats'],
            'marquee items' => ['/admin/marquee-items'],
            'social links' => ['/admin/social-links'],
            'pages' => ['/admin/pages'],
            'services' => ['/admin/services'],
            'projects' => ['/admin/projects'],
            'team members' => ['/admin/team-members'],
            'job listings' => ['/admin/job-listings'],
            'testimonials' => ['/admin/testimonials'],
            'industries' => ['/admin/industries'],
            'process steps' => ['/admin/process-steps'],
            'why reasons' => ['/admin/why-reasons'],
            'problem cards' => ['/admin/problem-cards'],
        ];
    }
}
