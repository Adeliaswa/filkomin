<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalFlow extends Model
{
    protected $fillable = ['scope','steps','all_steps_required','updated_by'];

    protected $casts = [
        'steps' => 'array',
        'all_steps_required' => 'boolean',
    ];
}
