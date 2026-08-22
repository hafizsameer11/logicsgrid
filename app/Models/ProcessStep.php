<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = ['number', 'phase', 'title', 'outcome_label', 'description', 'sort_order'];
}
