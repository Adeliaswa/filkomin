<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\RsvpResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'token',
        'qr_code_url',
        'phone_wa',
        'email',
        'details',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function rsvpResponse()
    {
        return $this->hasOne(RsvpResponse::class);
    }
}