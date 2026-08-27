<?php

namespace Tests\Feature\Crm;

use App\Models\CrmExpense;
use App\Models\CrmPayment;
use App\Models\CrmProject;
use App\Models\CrmProposal;
use App\Models\CrmTask;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CrmCoreTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    private function member(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_TEAM_MEMBER,
            'status' => User::STATUS_ACTIVE,
            'designation' => 'Developer',
        ]);
    }

    #[Test]
    public function project_financial_calculations_work(): void
    {
        $admin = $this->admin();
        $project = CrmProject::create([
            'name' => 'Test Project',
            'project_value' => 5000,
            'start_date' => now()->toDateString(),
            'deadline' => now()->addMonth()->toDateString(),
            'status' => 'in_progress',
        ]);

        CrmExpense::create([
            'type' => 'project',
            'crm_project_id' => $project->id,
            'amount' => 800,
            'expense_date' => now()->toDateString(),
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        CrmPayment::create([
            'crm_project_id' => $project->id,
            'amount' => 3000,
            'payment_date' => now()->toDateString(),
            'status' => 'partially_paid',
        ]);

        $this->assertSame(800.0, $project->fresh()->totalExpenses());
        $this->assertSame(3000.0, $project->fresh()->totalPaymentsReceived());
        $this->assertSame(2000.0, $project->fresh()->remainingPayment());
        $this->assertSame(4200.0, $project->fresh()->profit());
    }

    #[Test]
    public function expenses_cannot_be_deleted_via_resource_policy(): void
    {
        $this->assertFalse(\App\Filament\Resources\CrmExpenses\CrmExpenseResource::canDeleteAny());
    }

    #[Test]
    public function team_member_can_access_admin_panel(): void
    {
        $member = $this->member();
        $panel = filament()->getPanel('admin');

        $this->assertTrue($member->canAccessPanel($panel));
    }

    #[Test]
    public function inactive_user_cannot_access_admin_panel(): void
    {
        $member = $this->member();
        $member->update(['status' => User::STATUS_INACTIVE]);
        $panel = filament()->getPanel('admin');

        $this->assertFalse($member->fresh()->canAccessPanel($panel));
    }

    #[Test]
    public function admin_can_open_crm_pages(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get('/admin/crm-projects')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-tasks')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-expenses')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-payments')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-team-members')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-proposals')
            ->assertOk();
    }

    #[Test]
    public function proposal_stores_client_and_link(): void
    {
        $admin = $this->admin();

        $proposal = CrmProposal::create([
            'title' => 'Website Rebuild',
            'client_name' => 'Acme',
            'client_email' => 'ops@acme.com',
            'link' => 'https://example.com/job/123',
            'proposed_amount' => 1200,
            'status' => 'unanswered',
            'submitted_at' => now()->toDateString(),
            'created_by' => $admin->id,
        ]);

        $this->assertSame('unanswered', $proposal->status);
        $this->assertSame('https://example.com/job/123', $proposal->link);
    }

    #[Test]
    public function admin_can_update_own_password_and_other_user_password(): void
    {
        $admin = $this->admin();
        $member = $this->member();

        $admin->update(['password' => 'NewAdminPass123!']);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('NewAdminPass123!', $admin->fresh()->password));

        $member->update(['password' => 'NewMemberPass123!']);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('NewMemberPass123!', $member->fresh()->password));

        $this->actingAs($admin)
            ->get('/admin/crm-team-members/'.$admin->id.'/edit')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/crm-team-members/'.$member->id.'/edit')
            ->assertOk();

        $this->actingAs($admin)
            ->get('/admin/profile')
            ->assertOk();
    }

    #[Test]
    public function team_member_cannot_open_proposals(): void
    {
        $member = $this->member();

        $this->actingAs($member)
            ->get('/admin/crm-proposals')
            ->assertForbidden();
    }

    #[Test]
    public function team_member_cannot_open_expenses(): void
    {
        $member = $this->member();

        $this->actingAs($member)
            ->get('/admin/crm-expenses')
            ->assertForbidden();
    }

    #[Test]
    public function fixed_monthly_expense_can_be_created(): void
    {
        $admin = $this->admin();

        $expense = CrmExpense::create([
            'type' => 'fixed',
            'title' => 'Salaries',
            'amount' => 8000,
            'expense_date' => now()->toDateString(),
            'is_recurring' => true,
            'recurrence' => 'monthly',
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        $this->assertNull($expense->crm_project_id);
        $this->assertTrue($expense->is_recurring);
        $this->assertSame('Salaries', $expense->displayTitle());
    }

    #[Test]
    public function task_belongs_to_project_and_assignee(): void
    {
        $member = $this->member();
        $project = CrmProject::create([
            'name' => 'App Build',
            'project_value' => 1000,
            'start_date' => now()->toDateString(),
            'deadline' => now()->addMonth()->toDateString(),
            'status' => 'pending',
        ]);

        $task = CrmTask::create([
            'crm_project_id' => $project->id,
            'assigned_user_id' => $member->id,
            'name' => 'API',
            'deadline' => now()->addWeek()->toDateString(),
            'priority' => 'high',
            'status' => 'pending',
        ]);

        $this->assertSame('App Build', $task->project->name);
        $this->assertSame($member->id, $task->assignee->id);
    }
}
