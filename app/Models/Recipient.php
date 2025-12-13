<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\RsvpResponse;

class Recipient extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function rsvp()
    {
        return $this->hasOne(RsvpResponse::class);
    }
}
