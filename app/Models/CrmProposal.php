<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrmProposal extends Model
{
    protected $table = 'crm_proposals';

    protected $fillable = [
        'title',
        'client_name',
        'client_email',
        'client_company',
        'link',
        'proposed_amount',
        'status',
        'submitted_at',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'proposed_amount' => 'decimal:2',
            'submitted_at' => 'date',
        ];
    }

    public const STATUSES = [
        'unanswered' => 'Unanswered',
        'won' => 'Won',
        'lost' => 'Lost',
        'in_discussion' => 'In Discussion',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
