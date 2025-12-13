<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipient;

class RsvpResponse extends Model
{
    protected $fillable = [
        'recipient_id',
        'status',
        'total_guests',
        'notes',
    ];
    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }
}
