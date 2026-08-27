<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CrmProject extends Model
{
    protected $table = 'crm_projects';

    protected $fillable = [
        'name',
        'project_value',
        'start_date',
        'deadline',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'project_value' => 'decimal:2',
            'start_date' => 'date',
            'deadline' => 'date',
        ];
    }

    public const STATUSES = [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'on_hold' => 'On Hold',
        'cancelled' => 'Cancelled',
    ];

    public function teamMembers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'crm_project_user')
            ->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(CrmTask::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(CrmExpense::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(CrmPayment::class);
    }

    public function totalExpenses(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    public function totalPaymentsReceived(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function remainingPayment(): float
    {
        return max(0, (float) $this->project_value - $this->totalPaymentsReceived());
    }

    public function profit(): float
    {
        return (float) $this->project_value - $this->totalExpenses();
    }

    public function paymentStatusLabel(): string
    {
        $received = $this->totalPaymentsReceived();
        $value = (float) $this->project_value;

        if ($received <= 0) {
            return 'Pending';
        }

        if ($received >= $value) {
            return 'Paid';
        }

        return 'Partially Paid';
    }
}
