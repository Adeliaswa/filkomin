<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id','action','entity_type','entity_id','description',
        'metadata','ip','user_agent'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];
}
