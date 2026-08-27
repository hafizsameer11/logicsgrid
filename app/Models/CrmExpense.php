<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmExpense extends Model
{
    protected $table = 'crm_expenses';

    protected $fillable = [
        'type',
        'crm_project_id',
        'title',
        'amount',
        'expense_date',
        'is_recurring',
        'recurrence',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'expense_date' => 'date',
            'is_recurring' => 'boolean',
        ];
    }

    public const TYPES = [
        'project' => 'Project Expense',
        'fixed' => 'Fixed Monthly Expense',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(CrmProject::class, 'crm_project_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function displayTitle(): string
    {
        if ($this->type === 'fixed') {
            return $this->title ?: 'Fixed Expense';
        }

        return $this->project?->name ?: 'Project Expense';
    }
}
