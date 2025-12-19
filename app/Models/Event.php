<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'eo_id',

        'title',
        'category',
        'organizer_name',
        'organizer_unit',
        'description',

        'date',
        'start_time',
        'end_time',

        'location_type',
        'location',
        'meeting_link',

        'dress_code',
        'notes',

        'invitation_type',

        'pic_name',
        'pic_whatsapp',
        'pic_email',
        'request_notes',

        'status',
        'approved_at',
        'approved_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // EO pembuat event
    public function eo()
    {
        return $this->belongsTo(User::class, 'eo_id');
    }

    // Admin yang approve
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Daftar tamu undangan
    public function guests()
    {
        return $this->hasMany(EventGuest::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
