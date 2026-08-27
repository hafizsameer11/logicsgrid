<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('team_member')->after('password');
            $table->string('designation')->nullable()->after('role');
            $table->string('status')->default('active')->after('designation');
        });

        Schema::create('crm_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('project_value', 12, 2)->default(0);
            $table->date('start_date');
            $table->date('deadline');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('crm_project_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crm_project_id')->constrained('crm_projects')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['crm_project_id', 'user_id']);
        });

        Schema::create('crm_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crm_project_id')->constrained('crm_projects')->cascadeOnDelete();
            $table->foreignId('assigned_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->date('deadline');
            $table->string('priority')->default('medium');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        Schema::create('crm_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('project'); // project | fixed
            $table->foreignId('crm_project_id')->nullable()->constrained('crm_projects')->nullOnDelete();
            $table->string('title')->nullable(); // for fixed expenses (Salary, Subscription, etc.)
            $table->decimal('amount', 12, 2);
            $table->date('expense_date');
            $table->boolean('is_recurring')->default(false);
            $table->string('recurrence')->nullable(); // monthly
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('crm_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crm_project_id')->constrained('crm_projects')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->date('payment_date');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crm_payments');
        Schema::dropIfExists('crm_expenses');
        Schema::dropIfExists('crm_tasks');
        Schema::dropIfExists('crm_project_user');
        Schema::dropIfExists('crm_projects');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'designation', 'status']);
        });
    }
};
