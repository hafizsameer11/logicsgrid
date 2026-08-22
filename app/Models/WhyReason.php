<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyReason extends Model
{
    protected $fillable = ['number', 'title', 'description', 'sort_order'];
}
