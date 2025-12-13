<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Template;
use App\Models\Recipient;

class Event extends Model
{
    public function organizer()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}
