<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'title',
        'date',
        'category',
        'location',
        'description',
        'dresscode',
        'status',
        'token',
    ];

    /**
     * Auto-generate token saat create
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->token)) {
                $event->token = Str::uuid();
            }
        });
    }

    /**
     * EO / User pembuat event
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Template undangan
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Daftar penerima undangan
     */
    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}
