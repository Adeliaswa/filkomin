<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Template;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    
protected $fillable = [
    'user_id',
    'template_id',
    'title',
    'event_time',
    'location',
    'description',
    'dresscode',
    'organizer',
    'token',
    'status', 
];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($event) {
            if (empty($event->token)) {
                $event->token = Str::uuid()->toString();
            }
        });
    }

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