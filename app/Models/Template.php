<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Template extends Model
{
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
