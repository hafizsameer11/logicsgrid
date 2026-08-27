<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmPayment extends Model
{
    protected $table = 'crm_payments';

    protected $fillable = [
        'crm_project_id',
        'amount',
        'payment_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_date' => 'date',
        ];
    }

    public const STATUSES = [
        'pending' => 'Pending',
        'partially_paid' => 'Partially Paid',
        'paid' => 'Paid',
        'overdue' => 'Overdue',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(CrmProject::class, 'crm_project_id');
    }
}
