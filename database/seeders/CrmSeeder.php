<?php

namespace Database\Seeders;

use App\Models\CrmExpense;
use App\Models\CrmPayment;
use App\Models\CrmProject;
use App\Models\CrmProposal;
use App\Models\CrmTask;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CrmSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@logicsgrid.com'],
            [
                'name' => 'LogicsGrid Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'designation' => 'Administrator',
                'status' => User::STATUS_ACTIVE,
            ]
        );

        $ali = User::updateOrCreate(
            ['email' => 'ali@logicsgrid.com'],
            [
                'name' => 'Ali Khan',
                'password' => Hash::make('password'),
                'role' => User::ROLE_TEAM_MEMBER,
                'designation' => 'Backend Developer',
                'status' => User::STATUS_ACTIVE,
            ]
        );

        $ahmed = User::updateOrCreate(
            ['email' => 'ahmed@logicsgrid.com'],
            [
                'name' => 'Ahmed',
                'password' => Hash::make('password'),
                'role' => User::ROLE_TEAM_MEMBER,
                'designation' => 'Frontend Developer',
                'status' => User::STATUS_ACTIVE,
            ]
        );

        $project = CrmProject::updateOrCreate(
            ['name' => 'E-commerce Website'],
            [
                'project_value' => 5000,
                'start_date' => now()->subMonths(1)->toDateString(),
                'deadline' => now()->addMonths(1)->toDateString(),
                'status' => 'in_progress',
            ]
        );

        $project->teamMembers()->syncWithoutDetaching([$ali->id, $ahmed->id, $admin->id]);

        CrmTask::updateOrCreate(
            ['crm_project_id' => $project->id, 'name' => 'Create Login API'],
            [
                'assigned_user_id' => $ali->id,
                'deadline' => now()->addDays(7)->toDateString(),
                'priority' => 'high',
                'status' => 'in_progress',
            ]
        );

        CrmTask::updateOrCreate(
            ['crm_project_id' => $project->id, 'name' => 'Homepage UI'],
            [
                'assigned_user_id' => $ahmed->id,
                'deadline' => now()->addDays(5)->toDateString(),
                'priority' => 'medium',
                'status' => 'completed',
            ]
        );

        CrmExpense::updateOrCreate(
            [
                'type' => 'project',
                'crm_project_id' => $project->id,
                'amount' => 100,
                'expense_date' => now()->subDays(10)->toDateString(),
            ],
            [
                'created_by' => $ahmed->id,
                'updated_by' => $ahmed->id,
            ]
        );

        CrmExpense::updateOrCreate(
            [
                'type' => 'project',
                'crm_project_id' => $project->id,
                'amount' => 200,
                'expense_date' => now()->subDays(8)->toDateString(),
            ],
            [
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
            ]
        );

        CrmExpense::updateOrCreate(
            [
                'type' => 'fixed',
                'title' => 'Team Salaries',
                'expense_date' => now()->startOfMonth()->toDateString(),
            ],
            [
                'amount' => 8000,
                'is_recurring' => true,
                'recurrence' => 'monthly',
                'crm_project_id' => null,
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
            ]
        );

        CrmExpense::updateOrCreate(
            [
                'type' => 'fixed',
                'title' => 'AWS Subscription',
                'expense_date' => now()->startOfMonth()->toDateString(),
            ],
            [
                'amount' => 250,
                'is_recurring' => true,
                'recurrence' => 'monthly',
                'crm_project_id' => null,
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
            ]
        );

        CrmPayment::updateOrCreate(
            [
                'crm_project_id' => $project->id,
                'amount' => 2000,
                'payment_date' => now()->subDays(20)->toDateString(),
            ],
            ['status' => 'partially_paid']
        );

        CrmPayment::updateOrCreate(
            [
                'crm_project_id' => $project->id,
                'amount' => 1500,
                'payment_date' => now()->subDays(5)->toDateString(),
            ],
            ['status' => 'partially_paid']
        );

        CrmProposal::updateOrCreate(
            ['title' => 'Laravel CRM for Software Agency'],
            [
                'client_name' => 'John Smith',
                'client_email' => 'john@example.com',
                'client_company' => 'Acme Soft',
                'link' => 'https://www.upwork.com/jobs/~example-job',
                'proposed_amount' => 2500,
                'status' => 'won',
                'submitted_at' => now()->subDays(14)->toDateString(),
                'notes' => 'Clear scope + timeline. Client replied within 2 days.',
                'created_by' => $admin->id,
            ]
        );

        CrmProposal::updateOrCreate(
            ['title' => 'React Dashboard Redesign'],
            [
                'client_name' => 'Sarah Lee',
                'client_email' => 'sarah@example.com',
                'client_company' => null,
                'link' => 'https://example.com/job/dashboard-redesign',
                'proposed_amount' => 1800,
                'status' => 'unanswered',
                'submitted_at' => now()->subDays(7)->toDateString(),
                'notes' => 'No reply after proposal. Generic cover letter.',
                'created_by' => $admin->id,
            ]
        );
    }
}
