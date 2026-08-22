<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemCard extends Model
{
    protected $fillable = ['number', 'title', 'description', 'solution_tag', 'sort_order'];
}
